@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h2>Chỉnh sửa Voucher</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="code" class="form-label">Mã giảm giá</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $voucher->code) }}" required>
        </div>

        <div class="mb-3">
            <label for="discount_type" class="form-label">Loại giảm giá</label>
            <select name="discount_type" id="discount_type" class="form-control" required>
                <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Giảm cố định</option>
                <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Giảm theo %</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="discount_value" class="form-label">Giá trị giảm</label>
            <input type="number" name="discount_value" id="discount_value" class="form-control" value="{{ old('discount_value', $voucher->discount_value) }}" required>
        </div>

        <div class="mb-3">
            <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
            <input type="number" name="min_order_value" id="min_order_value" class="form-control" value="{{ old('min_order_value', $voucher->min_order_value) }}">
        </div>

        <div class="mb-3">
            <label for="max_discount_amount" class="form-label">Mức giảm tối đa (chỉ áp dụng cho %)</label>
            <input type="number" name="max_discount_amount" id="max_discount_amount" class="form-control" value="{{ old('max_discount_amount', $voucher->max_discount_amount) }}">
        </div>

        <div class="mb-3">
            <label for="start" class="form-label">Ngày bắt đầu</label>
            <input type="date" name="start" id="start" class="form-control" value="{{ old('start', $voucher->start) }}" required>
        </div>

        <div class="mb-3">
            <label for="end" class="form-label">Ngày kết thúc</label>
            <input type="date" name="end" id="end" class="form-control" value="{{ old('end', $voucher->end) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $voucher->is_active ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ !$voucher->is_active ? 'selected' : '' }}>Tắt</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
