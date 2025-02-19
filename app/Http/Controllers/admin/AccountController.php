<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = User::all();

        return view('admin.account.show', compact('data'));
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
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'gender' => 'required|in:Nam,Nu,Khac',
            'phone' => 'required|numeric|digits_between:10,15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        // Xử lý ảnh nếu có tải lên
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName);
        } else {
            $imageName = null; // Nếu không có ảnh, đặt giá trị null
        }

        // Lưu dữ liệu vào database
        User::create([
            'name' => $validated['name'],
            'password' => $validated['password'],
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'image' => $imageName,
            'status' => $validated['status'],
        ]);

        return redirect()->route('account.index')->with('success', 'Người dùng đã được thêm thành công.');
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
            'password' => 'nullable|string|min:6',
            'gender' => 'required|in:Nam,Nu,Khac',
            'phone' => 'required|numeric|digits_between:10,15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        // Cập nhật thông tin người dùng
        $account->name = $validated['name'];
        if ($request->filled('password')) {
            $account->password = bcrypt($validated['password']);
        }
        $account->gender = $validated['gender'];
        $account->phone = $validated['phone'];
        $account->status = $validated['status'];

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

        return redirect()->route('account.index')->with('success', 'Cập nhật tài khoản thành công!');
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

        return redirect()->route('account.index')->with('success', 'Người dùng đã được xóa!');
    }

}
