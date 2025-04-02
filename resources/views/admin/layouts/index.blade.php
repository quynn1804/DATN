<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ADMIN</title>

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
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">{{ $title ?? 'Dashboard' }}</li>
              </ol>
              
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->
      
        <!-- Main content -->
        <section class="content">

        @yield('content')
        <!-- /.content-header -->

        <!-- Main content -->
        {{-- <section class="content">

          <div class="container-fluid">
            <div class="row mb-4">
              <div class="col-12 text-center">
                <h2 class="text-uppercase font-weight-bold">BẢNG THỐNG KÊ THÁNG <?= date('m') ?></h2>
                <p class="text-muted">Tổng quan hoạt động trong tháng</p>
              </div>

            </div>
           
            <!-- Info boxes -->
            <div class="row d-flex justify-content-between">

            </div> --}}

            <!-- Info boxes -->
            {{-- <div class="row d-flex justify-content-between">

              <!-- Sản phẩm bán chạy -->
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="info-box">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Sản phẩm bán chạy</span>
                    <a href="#">
                      <span class="info-box-number">#</span>
                    </a>
                    <span class="info-box-number text-muted"></span>
                  </div>
                </div>
              </div>

              <!-- Tổng đơn hàng -->
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="info-box">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Tổng đơn hàng</span>
                    <a href="#"><span class="info-box-number">#</span></a>
                  </div>
                </div>
              </div>

              <!-- Doanh thu -->
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="info-box">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Doanh thu</span>
                    <span class="info-box-number">#</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          </div> --}}

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
