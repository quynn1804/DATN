@extends('admin.layouts.index')

@section('content')
<h2>Danh sách đơn hàng</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Mã đơn hàng</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_code }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order->id) }}">Chi tiết</a>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@endsection
