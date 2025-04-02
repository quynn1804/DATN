<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Account</title>

    <!-- Thêm các link tài nguyên nội bộ vào Laravel -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">


    {{-- /// --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
    @include('admin.layouts.header')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="{{ route('admin.account.index') }}">Home</a></li>

                            <li class="breadcrumb-item active">Quản lí tài khoản</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <div class="bg-white rounded-lg shadow-md" style="margin-left: 50px;margin-right: 50px; border-radius: 2px">
                <div class="card-header mb-4" style="background:#ebe8ff;border-radius: 2px; height: 55px;">
                    <h4 class="text-center" style="font-weight: 400; ">Thêm mới người dùng</h4>
                </div>

                <form action="{{ route('admin.account.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row justify-content-between text-left" style="margin-left: 100px;margin-right: 100px">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name') }}" id="name"
                                    name="name" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Giới tính <span
                                        class="text-danger">*</span></label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nu">Nữ</option>
                                    <option value="Khac">Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{ old('email') }}" id="email"
                                    name="email" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('phone') }}" id="phone"
                                    name="phone" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Vai trò <span
                                        class="text-danger">*</span></label>
                                <select id="role_id" name="role_id" class="form-control" required>
                                    <option value="2">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" required>

                            </div>
                        </div>


                        <div class="col-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hoạt động
                                    </option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tạm dừng
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="margin: 50px;">Thêm
                                    mới</button>
                            </div>
                        </div>
                </form>

            </div>
        </section>
        <!-- /.content -->
    </div>

    @include('admin.layouts.footer')

    <!-- Chèn script cần thiết -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Nếu có các script nội bộ, dùng asset() -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>


    {{-- /// --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        /* Cấu trúc chung cho các ô */
        .info-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        /* Đặt màu nền của các icon */
        .info-box .info-box-icon {
            border-radius: 10px 0 0 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
        }

        /* Nội dung trong các ô */
        .info-box .info-box-content {
            padding: 15px;
        }

        /* Phần chữ mô tả */
        .info-box .info-box-text {
            font-size: 1rem;
            font-weight: bold;
            color: #444;
        }

        /* Số liệu trong ô */
        .info-box .info-box-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
        }

        /* Thêm hiệu ứng hover cho các ô */
        .info-box:hover {
            transform: translateY(-5px);
            /* Di chuyển nhẹ lên */
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            /* Tăng cường hiệu ứng bóng đổ */
            background-color: #f7f7f7;
            /* Đổi màu nền nhẹ */
            cursor: pointer;
            /* Thêm con trỏ tay */
        }

        /* Hiệu ứng cho các icon */
        .info-box-icon:hover {
            background-color: #e0e0e0;
            /* Chỉnh màu nền của icon khi hover */
        }

        /* Cấu trúc cho các ô trong một hàng */
        .row {
            margin-left: 0;
            margin-right: 0;
        }

        @media (max-width: 767px) {
            .info-box {
                margin-bottom: 15px;
                /* Thêm khoảng cách dưới cho các ô khi màn hình nhỏ */
            }
        }
    </style>

</body>

</html>
