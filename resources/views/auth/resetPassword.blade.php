@extends('user.layouts.master')
@section('title', 'Quên Mật Khẩu')

@section('content')
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Đặt Lại Mật Khẩu
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Đặt Lại Mật Khẩu</h1>
        </div>
    </div>
    <div class="container login-container">

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="d-flex justify-content-center align-items-center">
                    <div style="width: 30%">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <fieldset>
                                @if ($errors->has('error'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('error') }}
                                    </div>
                                @endif

                                <label for="login-email">
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <input type="email" class="form-input form-wide" name="email" readonly placeholder="Email..." required  value="{{ old('email', $email) }}"  />
                                @error('email')
                                    <div class="text-danger fst-italic">
                                        <span class="required">*</span> {{ $message }}
                                    </div>
                                @enderror
                                

                                <div class="mb-1">
                                    <label for="login-email">
                                        Mật Khẩu
                                        <span class="required">*</span>
                                    </label>
                                    <input type="password" class="form-input form-wide" name="password"
                                        placeholder="Mật Khẩu Mới..." required />
                                    @error('password')
                                        <div class="text-danger fst-italic">
                                            <span class="required">*</span>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label for="login-email">
                                        Xác Nhận Mật Khẩu
                                        <span class="required">*</span>
                                    </label>
                                    <input type="password" class="form-input form-wide" name="password_confirmation"
                                        placeholder="Xác Nhận Mật Khẩu..." required />

                                </div>
                            </fieldset>
                            <div class="btn-wrapper">
                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    Đặt Lại Mật Khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
