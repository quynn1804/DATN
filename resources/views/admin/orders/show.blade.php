@extends('admin.layouts.master')
@section('title', 'Chi tiết đơn hàng')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Chi tiết đơn hàng</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">
                            <a href="{{ route('admin.orders.index') }}">Danh sách</a>
                        </li>
                        <li class="breadcrumb-item">{{ $order->order_code }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-4 mb-4">
                <p><strong>Mã đơn hàng :</strong> {{ $order->order_code }}</p>
                <p><strong>Tài Khoản :</strong> {{ $order->user->name ?? 'Khách vãng lai' }}</p>
                <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
                <p><strong>Địa chỉ :</strong> {{ $order->address }}</p>
                <p><strong>Số điện thoại :</strong> {{ $order->phone }}</p>
                @php
                    $paymentMethods = [
                        'cash' => 'Thanh toán khi nhận hàng',
                        'vnpay' => 'Thanh toán VNPAY',
                        'momo' => 'Thanh toán MoMo',
                        'credit_card' => 'Thẻ tín dụng',
                        // Thêm phương thức thanh toán khác nếu có
                    ];

                    $paymentMethod = $order->payment_method;
                    $paymentName = $paymentMethods[$paymentMethod] ?? $paymentMethod; // Nếu không có trong mảng thì hiển thị giá trị gốc
                @endphp

                <p><strong>Hình thức thanh toán :</strong> {{ $paymentName }}</p> @php
                    $statusNames = [
                        'pending' => 'Chờ xử lý',
                        'processing' => 'Đang xử lý',
                        'shipping' => 'Đang giao hàng',
                        'shipped' => 'Đã giao hàng',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy',
                        // Thêm trạng thái khác nếu có
                    ];

                    $status = $order->status;
                    $statusName = $statusNames[$status] ?? 'Không xác định';

                    $badgeClass = match ($status) {
                        'pending' => 'warning',
                        'processing' => 'primary',
                        'shipping' => 'info',
                        'shipped' => 'orange',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    };
                @endphp

                <p><strong>Trạng thái đơn hàng:</strong>
                    <span class="badge bg-{{ $badgeClass }}">
                        {{ $statusName }}
                    </span>
                </p>
                <p><strong>Giá trị đơn hàng:</strong> {{ number_format($order->total_money, 0, ',', '.') }} đ</p>
            </div>


            <h3>Sản phẩm:</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Màu Sắc / Dung Lượng</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->productVariant->product->name }}</td>
                            <td>{{ $detail->productVariant->color->name ?? '' }} /
                                {{ $detail->productVariant->capacity->name ?? '' }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->price_at_time, 0, ',', '.') }} đ</td>
                            <td>{{ number_format($detail->total_price, 0, ',', '.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Trạng thái đơn hàng:</label>
                    @php
                        $currentStatus = $order->status;
                     $validTransitions = [
                            'pending' => ['processing', 'cancelled'],
                            'processing' => ['shipping', 'cancelled'],
                            'shipping' => ['shipped', 'cancelled'],
                            'shipped' => ['completed', 'cancelled'],
                            'completed' => [],
                            'cancelled' => [],
                        ];
                        $allowedStatuses = $validTransitions[$currentStatus] ?? [];
                    @endphp

                    <select name="status" class="form-control w-25">
                        {{-- Luôn có option trạng thái hiện tại (để giữ nguyên) --}}
                        <option value="{{ $currentStatus }}" selected>{{ $statusNames[$currentStatus] ?? $currentStatus }}
                        </option>

                        {{-- Các trạng thái được phép chuyển sang --}}
                        @foreach ($allowedStatuses as $status)
                            <option value="{{ $status }}">{{ $statusNames[$status] ?? $status }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
            </form>

        </div>
    </div>
@endsection
