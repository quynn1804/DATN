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
            <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Trạng thái:</strong>
                <span class="badge badge-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'primary' : ($order->status == 'shipping' ? 'info' : ($order->status == 'completed' ? 'success' : 'danger'))) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_money, 0, ',', '.') }} đ</p>
        </div>


        <h3>Sản phẩm:</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->productVariant->product->name }}</td>
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
                <select name="status" class="form-control w-25">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao hàng</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
        </form>

    </div>
</div>
@endsection
