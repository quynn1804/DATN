@extends('user.layouts.master')
@section('title', 'Register')

@section('content')
<div class="page-header">
    <div class="container d-flex flex-column align-items-center">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Register
                    </li>
                </ol>
            </div>
        </nav>

        <h1>Đăng ký tài khoản</h1>
    </div>
</div>


<div class="container login-container">
    <div class="col-lg-12 mx-auto">
        <div class="d-flex justify-content-center align-items-center">
            <div style="width: 30%">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label>
                            Họ tên
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-input form-wide" name="name" value="{{ old('name') }}" placeholder="Nhập họ tên" required>
                        @error('name')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div>
                        <label for="register-email">
                            Email
                            <span class="required">*</span>
                        </label>
                        <input type="email" name="email" class="form-input form-wide" id="register-email" value="{{ old('email') }}" placeholder="Nhập email" required />
                        @error('email')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="register-password">
                            Mật khẩu
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password" class="form-input form-wide" id="register-password" value="{{ old('password') }}" placeholder="Nhập mật khẩu" required />
                        @error('password')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="register-password">
                            Xác nhận mật khẩu
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-input form-wide" id="register-password" value="{{ old('password_confirmation') }}" placeholder="Xác nhận mật khẩu" required />
                        @error('password_confirmation')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="register-password">
                            Giới tính
                            <span class="required">*</span>
                        </label>
                        <select name="gender" required class="form-control">
                            <option value="" disabled selected>Chọn giới tính</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                        @error('gender')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="register-password">
                            Số điện thoại
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="phone" class="form-input form-wide" value="{{ old('phone') }}" placeholder="Số điện thoại" required />
                        @error('phone')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="register-password">
                            Hình ảnh
                            <span class="required">*</span>
                        </label>
                        <input type="file" name="image" class="form-input form-wide" id="register-password" value="{{ old('image') }}" required />
                        @error('image')
                        <div class="text-danger fst-italic">
                            <span class="required">*</span>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <p class="text-center text-gray-600 mt-4">Đã có tài khoản?
                            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Đăng nhập ngay</a>
                        </p>
                    </div>

                    <div class="form-footer mb-2">
                        <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
