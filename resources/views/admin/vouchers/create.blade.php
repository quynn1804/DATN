@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h2>Thêm Voucher Mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.vouchers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Mã Voucher</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <div class="mb-3">
            <label for="discount_type" class="form-label">Loại Giảm Giá</label>
            <select name="discount_type" class="form-control" id="discount_type" required>
                <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Giảm theo số tiền</option>
                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Giảm theo %</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="discount_value" class="form-label">Giá trị giảm</label>
            <input type="number" name="discount_value" class="form-control" min="0" value="{{ old('discount_value') }}" required>
        </div>

        <!-- Chỉ hiển thị nếu giảm theo phần trăm -->
        <div class="mb-3" id="max_discount_group" style="display: none;">
            <label for="max_discount_amount" class="form-label">Giảm giá tối đa (VNĐ)</label>
            <input type="number" name="max_discount_amount" class="form-control" min="0" value="{{ old('max_discount_amount') }}">
        </div>

        <div class="mb-3">
            <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
            <input type="number" name="min_order_value" class="form-control" min="0" value="{{ old('min_order_value') }}">
        </div>

        <div class="mb-3">
            <label for="start" class="form-label">Ngày Bắt Đầu</label>
            <input type="date" name="start" class="form-control" value="{{ old('start') }}" required>
        </div>

        <div class="mb-3">
            <label for="end" class="form-label">Ngày Kết Thúc</label>
            <input type="date" name="end" class="form-control" value="{{ old('end') }}" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Trạng Thái</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ old('is_active', 1) == '1' ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Vô hiệu hóa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Tạo Voucher</button>
        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let discountType = document.getElementById('discount_type');
    let maxDiscountGroup = document.getElementById('max_discount_group');

    function toggleMaxDiscount() {
        if (discountType.value === 'percentage') {
            maxDiscountGroup.style.display = 'block';
        } else {
            maxDiscountGroup.style.display = 'none';
        }
    }

    discountType.addEventListener('change', toggleMaxDiscount);
    toggleMaxDiscount();
});
</script>
@endsection
