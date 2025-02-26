<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Account</title>

    <title>Document</title>

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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danh sách tài khoản</h5><br>
                        </div>
                        <div class="card-body">
<
                            <a class="btn btn-success" style="margin-bottom: 20px;"
                                href="{{ route('admin.account.create') }}">Thêm mới tài khoản</a><br>

                            <a class="btn btn-success" style="margin-bottom: 20px;" href="{{route('admin.account.create')}}">Thêm mới tài khoản</a><br>

                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Mật khẩu</th>
                                        <th>Giới tính</th>
                                        <th>Số điện thoại</th>
                                        <th>Ảnh</th>
                                        <th>trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>********</td> <!-- Không hiển thị mật khẩu -->
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <img src="{{ asset('assets/images/' . $item->image) }}" width="100px"
                                                    alt="Ảnh tài khoản">
                                            </td>
                                            <td>{{ $item->status }}</td>
                                            <td class="text-nowrap ">
                                                <a style="margin-right: 5px" class="btn btn-warning"
                                                    href="{{ route('account.edit', $item->id) }}">Sửa</a>
                                                <form action="{{ route('account.destroy', $item->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>

                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->password }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <img src="{{asset('assets/images/product/1-1.jpg')}}" width="100px" alt="">
                                        </td>
                                        <td>{{ $item->status }}</td>
                                        <td class="text-nowrap d-flex">
                                            <a style="margin-right: 5px" class="btn btn-warning" href="#">Sửa</a>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Bạn có chắc chắn muốn thực hiện hành động này?')"
                                                    type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
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
