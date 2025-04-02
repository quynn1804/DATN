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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản lí tài khoản</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container mt-4">
                <h1 class="text-center">Chỉnh sửa tài khoản</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.account.update', $account->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tên -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $account->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $account->email) }}" required>
                    </div>

                    <!-- Mật khẩu -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu (để trống nếu không muốn thay đổi)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- Giới tính -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Giới tính</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option value="Nam" {{ old('gender', $account->gender) == 'Nam' ? 'selected' : '' }}>Nam
                            </option>
                            <option value="Nữ" {{ old('gender', $account->gender) == 'Nữ' ? 'selected' : '' }}>Nữ
                            </option>
                            <option value="Khác" {{ old('gender', $account->gender) == 'Khác' ? 'selected' : '' }}>
                                Khác</option>
                        </select>
                    </div>

                    <!-- Số điện thoại -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone', $account->phone) }}" required>
                    </div>

                    <!-- Ảnh đại diện -->
                    <div class="mb-3">
                        <label class="form-label">Ảnh đại diện</label>
                        @if ($account->image)
                            <div>
                                <img src="{{ asset('assets/images/' . $account->image) }}" width="120px"
                                    class="mb-2">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image">
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="1" {{ old('status', $account->status) == 1 ? 'selected' : '' }}>Hoạt
                                động</option>
                            <option value="0" {{ old('status', $account->status) == 0 ? 'selected' : '' }}>Khóa
                            </option>
                        </select>
                    </div>

                    <!-- Quyền người dùng -->
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Quyền</label>
                        <select id="role_id" name="role_id" class="form-control" required>
                            <option value="1" {{ old('role_id', $account->role_id) == 1 ? 'selected' : '' }}>Admin
                            </option>
                            <option value="2" {{ old('role_id', $account->role_id) == 2 ? 'selected' : '' }}>User
                            </option>
                        </select>
                    </div>

                    <!-- Nút lưu -->
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.account.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>


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
