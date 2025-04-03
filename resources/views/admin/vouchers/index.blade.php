@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h2>Danh sách Voucher</h2>
    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-success mb-3">Thêm mới</a>

    <!-- Tìm kiếm & Lọc -->
    <form method="GET" action="{{ route('admin.vouchers.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Tìm theo mã hoặc loại..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Lọc trạng thái --</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tắt</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Mã Voucher</th>
                <th>Loại</th>
                <th>Giá trị giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Lượt dùng / Giới hạn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $key => $voucher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $voucher->code }}</strong></td>
                <td>{{ $voucher->discount_type === 'fixed' ? 'Tiền mặt' : 'Phần trăm' }}</td>
                <td>
                    @if ($voucher->discount_type === 'fixed')
                        {{ number_format($voucher->discount_value) }} VNĐ
                    @else
                        {{ $voucher->discount_value }}%
                        @if ($voucher->max_discount_amount)
                            (Tối đa: {{ number_format($voucher->max_discount_amount) }} VNĐ)
                        @endif
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($voucher->start)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($voucher->end)->format('d/m/Y') }}</td>
                <td>{{ $voucher->used_count ?? 0 }} / {{ $voucher->usage_limit ?? '∞' }}</td>
                <td>
                    <span class="badge {{ $voucher->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $voucher->is_active ? 'Kích hoạt' : 'Tắt' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa voucher này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $vouchers->links() }}
</div>
@endsection
