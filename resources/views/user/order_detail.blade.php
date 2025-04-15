@extends('user.layouts.main')
@section('title')
    Chi tiết đơn hàng
@endsection
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
                            @elseif($order->status === 'shipping')
                                Đang giao hàng
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
                                @if (in_array($order->status, ['pending', 'processing']))
                                    <form id="cancelOrderForm" action="{{ route('orders.cancel', $order->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                                    </form>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{-- Form bình luận --}}
                    @if (Auth::check() && $order->status === 'completed')
                        <div class="col-lg-12">
                            <div id="commentFormContainer">
                                <h4>Viết bình luận</h4>
                                <form id="commentForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="product_id"
                                        value="{{ $order->orderDetails->first()->productVariant->product->id ?? '' }}">

                                    <label>Đánh giá:</label>
                                    <select name="rating">
                                        <option value="1">1 - Kém</option>
                                        <option value="2">2 - Tạm ổn</option>
                                        <option value="3" selected>3 - Bình thường</option>
                                        <option value="4">4 - Tốt</option>
                                        <option value="5">5 - Xuất sắc</option>
                                    </select>

                                    <label>Nội dung:</label>
                                    <textarea name="content" required></textarea>

                                    <button type="submit">Gửi bình luận</button>
                                </form>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#commentForm').submit(function(e) {
                                        e.preventDefault();

                                        var formData = {
                                            order_id: $('input[name="order_id"]').val(),
                                            product_id: $('input[name="product_id"]').val(),
                                            rating: $('select[name="rating"]').val(),
                                            content: $('textarea[name="content"]').val(),
                                            _token: "{{ csrf_token() }}"
                                        };

                                        $.ajax({
                                            url: "{{ route('comments.store', ['order' => $order->id]) }}",
                                            type: "POST",
                                            data: formData,
                                            dataType: "json",
                                            success: function(response) {
                                                alert(response.message);
                                                location.reload();
                                            },
                                            error: function(xhr) {
                                                var response = JSON.parse(xhr.responseText);
                                                if (response.message ===
                                                    "Bạn đã bình luận cho sản phẩm này trong đơn hàng này.") {
                                                    alert(response.message); // Hiển thị thông báo lỗi lên màn hình
                                                } else {
                                                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    @else
                        <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
                    @endif

                    <div class="col-lg-12 text-right">
                        <a href="{{ route('myAccount') }}" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Định dạng form bình luận */
        #commentFormContainer {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        #commentFormContainer h4 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        #commentForm label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        #commentForm select,
        #commentForm textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 14px;
        }

        #commentForm textarea {
            height: 100px;
            resize: vertical;
        }

        #commentForm button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        #commentForm button:hover {
            background: #218838;
        }
    </style>
    <script>
        function confirmCancel() {
            if (confirm("Bạn có chắc chắn muốn hủy đơn hàng này không?")) {
                document.getElementById('cancelOrderForm').submit();
            }
        }
    </script>
@endsection
