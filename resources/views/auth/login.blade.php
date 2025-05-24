@extends('user.layouts.master')
@section('title', 'Đăng nhập')

@section('content')
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Đăng Nhập
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Đăng Nhập</h1>
        </div>
    </div>


    <div class="container login-container">
        @if (session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif




        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="d-flex justify-content-center align-items-center">
                    <div style="width: 30%">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-1">
                                <label for="login-email">
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <input type="email" class="form-input form-wide" id="login-email" name="email"
                                    value="{{ old('email') }}" required />

                                @error('email')
                                    <div class="text-danger fst-italic">
                                        <span class="required">*</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="login-password">
                                    Mật Khẩu
                                    <span class="required">*</span>
                                </label>
                                <input type="password" class="form-input form-wide @error('password') is-invalid @enderror"
                                    id="login-password" name="password" value="{{ old('password') }}" required />

                                @error('password')
                                    <div class="text-danger fst-italic">
                                        <span class="required">*</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <div class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" class="custom-control-input" id="lost-password" />
                                    <label class="custom-control-label mb-0" for="lost-password">Ghi Nhớ Tôi</label>
                                </div>

                                <a href="{{ route('password.request') }}"
                                    class="forget-password text-dark form-footer-right">Bạn Quên Mật Khẩu?</a>
                            </div>


                            <div class="mb-3">
                                {{-- <a href="{{ route('register') }}" class="text-black-50 fs-3">Register</a> --}}

                                <p class="text-center text-gray-600 mt-4">Chưa có tài khoản?
                                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Đăng ký ngay</a>
                                </p>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md w-100">
                                Đăng Nhập
                            </button>
                            <a href="{{ route('google.login') }}" style="margin-bottom: 10px;"
                                class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i>Đăng Nhập Với Google+
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
