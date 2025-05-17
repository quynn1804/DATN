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
                            Quên Mật Khẩu
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Quên Mật Khẩu</h1>
        </div>
    </div>
    <div class="container login-container">

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="d-flex justify-content-center align-items-center">
                    <div style="width: 30%">
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <fieldset>
                                <div class="mb-1">
                                    <label for="login-email">
                                        Email
                                        <span class="required">*</span>
                                    </label>
                                    <input type="email" class="form-input form-wide" id="login-email" name="email"
                                        value="{{ old('email') }}" placeholder="Nhập email của bạn..." required />

                                    @error('email')
                                        <div class="text-danger fst-italic">
                                            <span class="required">*</span>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </fieldset>
                            <div class="btn-wrapper">
                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    Gửi liên kết đặt lại mật khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
