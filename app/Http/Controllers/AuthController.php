<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /** Hiển thị form đăng ký */
    public function showRegister()
    {
        return view('auth.register');
    }

    /** Xử lý đăng ký người dùng */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // xác nhận mật khẩu
            'gender' => 'required|in:Nam,Nữ,Khác',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,bmp|max:5120',
        ]);

        // Lấy role_id của role 'users'
        $userRole = Role::where('name', 'User')->first();

        if (!$userRole) {
            return back()->withErrors(['role' => 'Vai trò mặc định không tồn tại.']);
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName);
        }

        // Tạo người dùng mới với role 'users' mặc định
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'image' => $imageName,
            'role_id' => $userRole->id,
        ]);

        // Đăng nhập người dùng ngay sau khi đăng ký
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }

    /** Hiển thị form đăng nhập */
    public function showLogin()
    {
        return view('auth.login');
    }

    /** Xử lý đăng nhập */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Kiểm tra trạng thái tài khoản
            if (Auth::user()->status == 0) {
                Auth::logout();
                return back()->withErrors(['email' => 'Tài khoản đã bị khóa.']);
            }

            // Kiểm tra role
            $userRoleId = Auth::user()->role_id;

            if ($userRoleId == 1) { // Admin
                return redirect()->route('admin.statistic.index');
            } elseif ($userRoleId == 2) { // users
                return redirect()->route('home');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Tài khoản không có quyền truy cập.']);
            }
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }

    /** Xử lý đăng xuất */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
