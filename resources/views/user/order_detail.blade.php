@extends('user.layouts.main')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Chi Tiết Đơn Hàng</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Chi Tiết Đơn Hàng</li>
                </ul>
            </div>
        </div>
    </div>

    <main class="page-content">
        <div class="order-details-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Mã Đơn Hàng: {{ $order->order_code }}</h4>
                        <p><strong>Ngày Đặt:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
                        <p><strong>Trạng Thái:</strong>
                            @if ($order->status === 'pending')
                                Đang chờ xử lý
                            @elseif($order->status === 'processing')
                                Đang xử lý
                            @elseif($order->status === 'completed')
                                Hoàn thành
                            @elseif($order->status === 'cancelled')
                                Đã hủy
                            @endif
                        </p>
                        <p><strong>Tổng Tiền:</strong> {{ number_format($order->total_money, 0, ',', '.') }} VNĐ</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ number_format($detail->price_at_time, 0, ',', '.') }} đ</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ number_format($detail->total_price, 0, ',', '.') }} đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(Auth::check())
                            <h4>Viết bình luận</h4>
                            <form action="{{ route('comments.store', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $detail->product->id }}">
                                <div class="form-group">
                                    <label for="rating">Đánh giá:</label>
                                    <select name="rating" id="rating" required class="form-control">
                                        <option value="5">⭐ 5 - Rất tốt</option>
                                        <option value="4">⭐ 4 - Tốt</option>
                                        <option value="3">⭐ 3 - Bình thường</option>
                                        <option value="2">⭐ 2 - Không tốt</option>
                                        <option value="1">⭐ 1 - Rất tệ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung:</label>
                                    <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                            </form>
                        @else
                            <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
                        @endif
                            <div class="col-lg-12 text-right">
                                <a href="{{ route('myAccount') }}" class="kenne-btn kenne-btn_sm">Quay lại danh sách đơn
                                    hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
@endsection
