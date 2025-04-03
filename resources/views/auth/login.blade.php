@extends('user.layouts.main')
@section('content')
    <!DOCTYPE html>
    <html>
    <script src="https://cdn.tailwindcss.com"></script>

    <head>
        <title>Đăng nhập</title>
    </head>

    <body class="bg-gray-100">

        <div class="flex items-center justify-center ">
            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Đăng nhập tài khoản</h2>

                @if ($errors->any())
                    <div class="mb-4">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-500 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input type="email" name="email" placeholder="Email" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Mật khẩu" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition">Đăng
                            nhập</button>
                    </div>
                </form>

                <p class="text-center text-gray-600 mt-4">Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Đăng ký ngay</a>
                </p>
            </div>
        </div>

    </body>

    </html>
@endsection
