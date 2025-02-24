<!DOCTYPE html>
<html>
<head><title>Đăng ký</title></head>
<body>
    <h2>Đăng ký tài khoản khách hàng</h2>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color:red">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Họ tên" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Mật khẩu" required><br>
        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required><br>

        <select name="gender" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br>

        <input type="text" name="phone" placeholder="Số điện thoại (tùy chọn)"><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
</body>
</html>
