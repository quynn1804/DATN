@extends('admin.layouts.index')

@section('content')
<h2>Danh sách đơn hàng</h2>

<!-- Form tìm kiếm -->
<form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3">
    <input type="text" name="search" placeholder="Nhập mã đơn hàng hoặc tên khách hàng..." value="{{ request('search') }}">
    <button type="submit">Tìm kiếm</button>
</form>

@if ($orders->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->order_code }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
                <td>
                    @php
                        $statusColor = [
                            'pending' => 'text-warning',
                            'processing' => 'text-primary',
                            'completed' => 'text-success',
                            'cancelled' => 'text-danger'
                        ];
                    @endphp
                    <span class="{{ $statusColor[$order->status] ?? 'text-secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                         <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@else
    <p class="text-center">Không có đơn hàng nào.</p>
@endif
@endsection
