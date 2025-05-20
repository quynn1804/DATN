@extends('user.layouts.master')
@section('title', 'Đã Gửi Liên Kết')

@section('content')
<div class="container text-center py-5">
    <h2>✅ Liên kết đặt lại mật khẩu đã được gửi!</h2>
    <p>Vui lòng kiểm tra email của bạn để tiếp tục đặt lại mật khẩu.</p>

    <p>Đã gửi đến: <strong>{{ $email }}</strong></p>

    <form action="{{ route('password.email') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit" class="btn btn-success">
            Gửi lại liên kết
        </button>
    </form>
    

    <a href="{{ route('home') }}" class="btn btn-dark btn-md">Quay về trang chủ</a>
</div>
@endsection
