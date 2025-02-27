@extends('admin.layouts.index')

@section('content')
<h2>Chi tiết đơn hàng #{{ $order->order_code }}</h2>
<p><strong>Khách hàng:</strong> {{ $order->name }}</p>
<p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
<p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
<p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
<p><strong>Tổng tiền:</strong> {{ number_format($order->total_money, 0, ',', '.') }} đ</p>

<h3>Sản phẩm:</h3>
<table>
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
            <td>{{ $detail->productVariant->name }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>{{ number_format($detail->price_at_time, 0, ',', '.') }} đ</td>
            <td>{{ number_format($detail->total_price, 0, ',', '.') }} đ</td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="status">Trạng thái đơn hàng:</label>
    <select name="status">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
    </select>
    <button type="submit">Cập nhật</button>
</form>

<a href="{{ route('admin.orders.index') }}">Quay lại</a>
@endsection
