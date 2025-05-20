<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('auth.resetPassword', ['token' => $token, 'email' => $request->email]);
    }

    public function ResetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email này chưa được đăng ký trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'token.required' => 'Mã token không hợp lệ hoặc đã hết hạn.'
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($user, $password){
                $user->forceFill([
                    'password'  => Hash::make($password)
                ])->save();
            }
        );
        if($status === Password::PASSWORD_RESET)
        {
            return redirect()->route('login')->with('success', 'Mật Khẩu Đã Được Đặt Lại Thành Công! Bạn có thể đăng nhập ngay.');
        }
        return back()->withErrors(['error' => 'Đặt lại mật khẩu không thành công']);
    }

}
