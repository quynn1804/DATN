@extends('user.layouts.main')
@section('title')
    Tài khoản của tôi
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Cửa hàng liên quan</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Tài khoản của tôi</li>
                </ul>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Page Content Area -->
    <main class="page-content">
        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-dashboard-tab" data-bs-toggle="tab"
                                    href="#account-dashboard" role="tab" aria-controls="account-dashboard"
                                    aria-selected="true">Trang Chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-orders-tab" data-bs-toggle="tab" href="#account-orders"
                                    role="tab" aria-controls="account-orders" aria-selected="false">Đơn Hàng</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address"
                                    role="tab" aria-controls="account-address" aria-selected="false">Địa Chỉ</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="account-details-tab" data-bs-toggle="tab" href="#account-details"
                                    role="tab" aria-controls="account-details" aria-selected="false">Chi tiết tài
                                    khoản</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-logout-tab" href="l#" role="tab"
                                    aria-selected="false">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-light">
                                            Đăng Xuất
                                        </button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel"
                                aria-labelledby="account-dashboard-tab">
                                <div class="myaccount-dashboard">
                                    <p>Xin Chào <b>{{ $user->name }}</b>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                            style="background: none; border: none; color: #007bff; cursor: pointer;">
                                            Đăng Xuất
                                        </button>
                                    </form>
                                    </p>

                                    <p>Từ bảng điều khiển tài khoản của bạn, bạn có thể xem các đơn hàng gần đây, quản lý
                                        địa chỉ giao hàng và
                                        thanh toán và <a href="#">chỉnh sửa mật khẩu và thông tin tài khoản của
                                            bạn.</a>.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-orders" role="tabpanel"
                                aria-labelledby="account-orders-tab">
                                @if ($orders->isEmpty())
                                    <p class="text-danger text-center">Bạn chưa có đơn hàng nào.</p>
                                @else
                                    <div class="myaccount-orders">
                                        <h4 class="small-title">ĐƠN HÀNG CỦA TÔI</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>Mã Đơn Hàng</th>
                                                        <th>Ngày Mua</th>
                                                        <th>Trạng Thái Đơn Hàng</th>
                                                        <th>Tổng Tiền</th>
                                                        <th></th>
                                                    </tr>
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td><a class="account-order-id"
                                                                    href="#">{{ $order->order_code }}</a></td>
                                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                            <td>
                                                                @if ($order->status === 'pending')
                                                                    Đang chờ xử lý
                                                                @elseif($order->status === 'processing')
                                                                    Đang xử lý
                                                                @elseif($order->status === 'shipping')
                                                                    Đang giao hàng
                                                                @elseif($order->status === 'completed')
                                                                    Hoàn thành
                                                                @elseif($order->status === 'cancelled')
                                                                    Đã hủy
                                                                @endif
                                                            </td>
                                                            <td>{{ number_format($order->total_money, 0, ',', '.') }} VNĐ
                                                            </td>
                                                            <td><a href="{{ route('user.order.detail', $order) }}"
                                                                    class="kenne-btn kenne-btn_sm"><span>Chi
                                                                        tiết</span></a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-center mt-3">
                                                {{ $orders->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            {{-- <div class="tab-pane fade" id="account-address" role="tabpanel"
                                aria-labelledby="account-address-tab">
                                <div class="myaccount-address">
                                    <p>Các địa chỉ sau đây sẽ được sử dụng trên trang thanh toán theo mặc định.</p>
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="small-title">Địa chỉ giao hàng</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-pane fade" id="account-details" role="tabpanel"
                                aria-labelledby="account-details-tab">
                                <div class="myaccount-details">

                                    {{-- @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif --}}

                                    <form action="{{ route('user.account.update') }}" method="POST" class="kenne-form">
                                        @csrf
                                        <div class="kenne-form-inner">
                                            <div class="single-input single-input-half">
                                                <label for="account-details-firstname">Họ Và Tên</label>
                                                <input type="text" id="account-details-firstname" name="name"
                                                    value="{{ $user->name }}" required>
                                            </div>

                                            <div class="single-input">
                                                <label for="account-details-email">Email</label>
                                                <input type="email" id="account-details-email" name="email"
                                                    value="{{ $user->email }}" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="single-input">
                                                <label for="account-details-oldpass">Mật khẩu mới (để trống nếu không thay
                                                    đổi)</label>
                                                <input type="password" id="account-details-oldpass" name="password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="single-input">
                                                <label for="account-details-confpass">Xác nhận mật khẩu mới</label>
                                                <input type="password" id="account-details-confpass"
                                                    name="password_confirmation">
                                            </div>

                                            <div class="single-input">
                                                <button class="kenne-btn kenne-btn_dark" type="submit"><span>LƯU THAY
                                                        ĐỔI</span></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kenne's Account Page Area End Here -->
    </main>

    <!-- Begin Brand Area -->
    <div class="brand-area ">
        <div class="container">
            <div class="brand-nav border-top ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kenne-element-carousel brand-slider slider-nav"
                            data-slick-options='{
                                    "slidesToShow": 6,
                                    "slidesToScroll": 1,
                                    "infinite": false,
                                    "arrows": false,
                                    "dots": false,
                                    "spaceBetween": 30
                                    }'
                            data-slick-responsive='[
                                    {"breakpoint":992, "settings": {
                                    "slidesToShow": 4
                                    }},
                                    {"breakpoint":768, "settings": {
                                    "slidesToShow": 3
                                    }},
                                    {"breakpoint":576, "settings": {
                                    "slidesToShow": 2
                                    }}
                                ]'>

                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/1.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/2.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/3.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/4.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/5.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/6.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/1.png" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="assets/images/brand/2.png" alt="Brand Images">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
