@extends('user.layouts.master')
@section('title', 'Tài khoản của Tôi')
@section('content')


    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <h1>
                {{ $user->name }}
            </h1>
        </div>
    </div>



    <div class="container account-container custom-account-container">
        <div class="row">
            <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"
                            aria-controls="dashboard" aria-selected="true">Tài khoản của tôi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                            aria-controls="order" aria-selected="true">Lịch sử đơn hàng</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                            aria-controls="edit" aria-selected="false">Thay đổi thông tin</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 order-lg-last order-1 tab-content">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-content">
                        <p>
                            Với giao diện này ,bạn có thể xem
                            <a class="btn btn-link link-to-tab" href="#order">Lịch sử đơn hàng</a>,
                            và thay đổi
                            <a class="btn btn-link link-to-tab" href="#edit">mật khẩu và thông thông tin tài khoản
                                .</a>
                        </p>

                        <div class="mb-4"></div>

                        <div class="row row-lg">
                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="#order" class="link-to-tab"><i class="sicon-social-dropbox"></i></a>
                                    <div class="feature-box-content">
                                        <h3>Lịch sử đơn hàng </h3>
                                    </div>
                                </div>
                            </div>


                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                    <div class="feature-box-content p-0">
                                        <h3>Thông tin cá nhân </h3>
                                    </div>
                                </div>
                            </div>



                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="{{ route('logout') }}"><i class="sicon-logout"></i></a>
                                    <div class="feature-box-content">
                                        <h3>Đăng xuất </h3>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .row -->
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="order" role="tabpanel">
                    <div class="order-content">
                        <h3 class="account-sub-title d-none d-md-block"><i
                                class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                        <div class="order-table-container text-center">

                            @if ($orders->isEmpty())
                                <p class="text-danger text-center">Bạn chưa có đơn hàng nào.</p>
                            @else
                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th>Mã Đơn Hàng</th>
                                            <th>Ngày Mua</th>
                                            <th>Trạng Thái Đơn Hàng</th>
                                            <th>Tổng Tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><a class="account-order-id" href="#">{{ $order->order_code }}</a>
                                                </td>
                                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    @if ($order->status === 'pending')
                                                        Đang chờ xử lý
                                                    @elseif($order->status === 'processing')
                                                        Đang xử lý
                                                    @elseif($order->status === 'shipping')
                                                        Đang giao hàng
                                                    @elseif($order->status === 'shipped')
                                                        Đã giao hàng
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
                                {{ $orders->links('pagination::bootstrap-4') }}

                            @endif
                            <hr class="mt-0 mb-3 pb-2" />

                            <a href="{{ route('pageCategory') }}" class="btn btn-dark">Mua hàng</a>
                        </div>
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="address" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mb-1"><i
                            class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
                    <div class="addresses-content">
                        <p class="mb-4">
                            The following addresses will be used on the checkout page by
                            default.
                        </p>

                        <div class="row">
                            <div class="address col-md-6">
                                <div class="heading d-flex">
                                    <h4 class="text-dark mb-0">Billing address</h4>
                                </div>

                                <div class="address-box">
                                    You have not set up this type of address yet.
                                </div>

                                <a href="#billing" class="btn btn-default address-action link-to-tab">Add
                                    Address</a>
                            </div>

                            <div class="address col-md-6 mt-5 mt-md-0">
                                <div class="heading d-flex">
                                    <h4 class="text-dark mb-0">
                                        Shipping address
                                    </h4>
                                </div>

                                <div class="address-box">
                                    You have not set up this type of address yet.
                                </div>

                                <a href="#shipping" class="btn btn-default address-action link-to-tab">Add
                                    Address</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="edit" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                            class="icon-user-2 align-middle mr-3 pr-1"></i>Thông tin cá nhân </h3>
                    <div class="account-content">



                        <form action="{{ route('updateAccount') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            required value="{{ old('name', $user->name) }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required value="{{ old('email', $user->email) }}" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Giới tính <span class="required">*</span></label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="Nam" {{ old('gender', $user->gender) == 'Nam' ? 'selected' : '' }}>
                                        Nam</option>
                                    <option value="Nữ" {{ old('gender', $user->gender) == 'Nữ' ? 'selected' : '' }}>Nữ
                                    </option>
                                    <option value="Khác" {{ old('gender', $user->gender) == 'Khác' ? 'selected' : '' }}>
                                        Khác</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại <span class="required">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" required
                                    value="{{ old('phone', $user->phone) }}" />
                            </div>

                            <div class="change-password">
                                <h3 class="text-uppercase mb-2">Password Change</h3>

                                <div class="form-group">
                                    <label for="password">Mật khẩu mới (để trống nếu như không đổi )</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Xác nhận mật khẩu </label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" />
                                </div>
                            </div>

                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" class="btn btn-dark mr-0">Lưu thay đổi </button>
                            </div>
                        </form>


                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="billing" role="tabpanel">
                    <div class="address account-content mt-0 pt-2">
                        <h4 class="title">Billing address</h4>

                        <form class="mb-2" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company </label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="select-custom">
                                <label>Country / Region <span class="required">*</span></label>
                                <select name="orderby" class="form-control">
                                    <option value="" selected="selected">British Indian Ocean Territory
                                    </option>
                                    <option value="1">Brunei</option>
                                    <option value="2">Bulgaria</option>
                                    <option value="3">Burkina Faso</option>
                                    <option value="4">Burundi</option>
                                    <option value="5">Cameroon</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Street address <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="House number and street name"
                                    required />
                                <input type="text" class="form-control"
                                    placeholder="Apartment, suite, unit, etc. (optional)" required />
                            </div>

                            <div class="form-group">
                                <label>Town / City <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>State / Country <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>Postcode / ZIP <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group mb-3">
                                <label>Phone <span class="required">*</span></label>
                                <input type="number" class="form-control" required />
                            </div>

                            <div class="form-group mb-3">
                                <label>Email address <span class="required">*</span></label>
                                <input type="email" class="form-control" placeholder="editor@gmail.com" required />
                            </div>

                            <div class="form-footer mb-0">
                                <div class="form-footer-right">
                                    <button type="submit" class="btn btn-dark py-4">
                                        Save Address
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="shipping" role="tabpanel">
                    <div class="address account-content mt-0 pt-2">
                        <h4 class="title mb-3">Shipping Address</h4>

                        <form class="mb-2" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company </label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="select-custom">
                                <label>Country / Region <span class="required">*</span></label>
                                <select name="orderby" class="form-control">
                                    <option value="" selected="selected">British Indian Ocean Territory
                                    </option>
                                    <option value="1">Brunei</option>
                                    <option value="2">Bulgaria</option>
                                    <option value="3">Burkina Faso</option>
                                    <option value="4">Burundi</option>
                                    <option value="5">Cameroon</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Street address <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="House number and street name"
                                    required />
                                <input type="text" class="form-control"
                                    placeholder="Apartment, suite, unit, etc. (optional)" required />
                            </div>

                            <div class="form-group">
                                <label>Town / City <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>State / Country <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>Postcode / ZIP <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-footer mb-0">
                                <div class="form-footer-right">
                                    <button type="submit" class="btn btn-dark py-4">
                                        Save Address
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    {{-- <div class="mb-5"></div><!-- margin -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'OK'
            });
        </script>
    @endif --}}

@endsection
