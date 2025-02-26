@extends('admin.layouts.main')

@section('content')
    <h2>Chi tiết đơn hàng - {{ $order->order_code }}</h2>
    <p>Khách hàng: {{ $order->name }}</p>
    <p>Số điện thoại: {{ $order->phone }}</p>
    <p>Địa chỉ: {{ $order->address }}</p>
    <p>Tổng tiền: {{ number_format($order->total_money, 0, ',', '.') }} VND</p>

    <h3>Sản phẩm trong đơn hàng</h3>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }} VND</li>
        @endforeach
    </ul>

    <h3>Cập nhật trạng thái đơn hàng</h3>
    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf
        <select name="status">
            <option value="pending" {{ $order->statuses->last()->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
            <option value="processing" {{ $order->statuses->last()->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="shipped" {{ $order->statuses->last()->status == 'shipped' ? 'selected' : '' }}>Đã gửi hàng</option>
            <option value="delivered" {{ $order->statuses->last()->status == 'delivered' ? 'selected' : '' }}>Đã nhận hàng</option>
            <option value="canceled" {{ $order->statuses->last()->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
        </select>
        <input type="text" name="note" placeholder="Ghi chú (không bắt buộc)">
        <button type="submit">Cập nhật</button>
    </form>

    <a href="{{ route('admin.orders.index') }}">Quay lại</a>
@endsection
