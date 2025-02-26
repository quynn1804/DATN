@extends('admin.layouts.main')

@section('content')
    <h2>Danh sách đơn hàng</h2>
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ number_format($order->total_money, 0, ',', '.') }} VND</td>
                    <td>{{ $order->statuses->last()->status ?? 'Chưa có trạng thái' }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}">Xem</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
