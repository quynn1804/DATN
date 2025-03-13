@extends('admin.layouts.index')


@section('content')
<div class="container">
    <h2>Danh sách Voucher</h2>
    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-success">Thêm mới</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã Voucher</th>
                <th>Loại</th>
                <th>Giảm giá tối đa</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $key => $voucher)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $voucher->code }}</td>
                <td>{{ $voucher->discount_type }}</td>
                <td>{{ $voucher->max_discount_amount }}</td>
                <td>{{ $voucher->start }}</td>
                <td>{{ $voucher->end }}</td>
                <td>
                    <span class="badge {{ $voucher->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $voucher->is_active ? 'Kích hoạt' : 'Tắt' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa voucher này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $vouchers->links() }}
</div>
@endsection
