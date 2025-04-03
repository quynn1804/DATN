@extends('user.layouts.main')
@section('content')

    <!DOCTYPE html>
    <script src="https://cdn.tailwindcss.com"></script>

    <html>

    <head>
        <title>Đăng ký</title>
    </head>

    <body class="bg-gray-100">

        <!-- Container căn giữa toàn màn hình -->
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Đăng ký tài khoản khách hàng</h2>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <input type="text" name="name" placeholder="Họ tên" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Mật khẩu" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <select name="gender" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>Chọn giới tính</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                    <div>
                        <input type="text" name="phone" placeholder="Số điện thoại (tùy chọn)"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <input type="file" name="image"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition">Đăng
                            ký</button>
                    </div>
                </form>

                <p class="text-center text-gray-600 mt-4">Đã có tài khoản?
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Đăng nhập ngay</a>
                </p>
            </div>
        </div>

    </body>

    </html>
@endsection
