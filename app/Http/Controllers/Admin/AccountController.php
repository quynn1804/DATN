<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = User::query()->latest('id')->paginate(10);

        return view('admin.account.show', ['title' => 'Quản lý tài khoản'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:Nam,Nữ,Khác',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,bmp|max:5120',
            'status' => 'required|boolean',
            'role_id' => 'required|exists:roles,id',
        ], [
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp.',
            'email.unique' => 'Email này đã được sử dụng, vui lòng chọn email khác.',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName);
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'image' => $imageName,
            'status' => $validated['status'],
            'role_id' => $validated['role_id'] ?? 2,
        ]);

        return redirect()->route('admin.account.index')->with('success', 'Người dùng đã được thêm thành công.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $account = User::findOrFail($id);
        return view('admin.account.edit', compact('account'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = User::findOrFail($id);

        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'gender' => 'required|in:Nam,Nữ,Khác',
            'phone' => 'required|numeric|digits_between:10,15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'role_id' => 'required|integer|in:1,2', // Thêm rule kiểm tra role_id
        ]);

        // Cập nhật thông tin người dùng
        $account->name = $validated['name'];
        $account->email = $validated['email'];
        if ($request->filled('password')) {
            $account->password = bcrypt($validated['password']);
        }
        $account->gender = $validated['gender'];
        $account->phone = $validated['phone'];
        $account->status = $validated['status'];
        $account->role_id = $validated['role_id']; // Thêm cập nhật role_id

        // Xử lý ảnh mới (nếu có)
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($account->image && file_exists(public_path('assets/images/' . $account->image))) {
                unlink(public_path('assets/images/' . $account->image));
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName);
            $account->image = $imageName;
        }

        // Lưu lại dữ liệu
        $account->save();

        return redirect()->route('admin.account.index')->with('success', 'Cập nhật tài khoản thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $account = User::findOrFail($id);

        // Xóa ảnh nếu có
        if ($account->image && file_exists(public_path('assets/images/' . $account->image))) {
            unlink(public_path('assets/images/' . $account->image));
        }

        // Xóa người dùng
        $account->delete();

        return redirect()->route('admin.account.index')->with('success', 'Người dùng đã được xóa!');
    }
}
