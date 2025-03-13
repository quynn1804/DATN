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
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="discount_type" class="form-label">Loại Giảm Giá</label>
            <select name="discount_type" class="form-control" required>
                <option value="fixed">Giảm theo số tiền</option>
                <option value="percentage">Giảm theo %</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="min_discount_amount" class="form-label">Giá trị giảm tối thiểu</label>
            <input type="number" name="min_discount_amount" class="form-control">
        </div>

        <div class="mb-3">
            <label for="max_discount_amount" class="form-label">Giá trị giảm tối đa</label>
            <input type="number" name="max_discount_amount" class="form-control">
        </div>

        <div class="mb-3">
            <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
            <input type="number" name="min_order_value" class="form-control">
        </div>

        <div class="mb-3">
            <label for="start" class="form-label">Ngày Bắt Đầu</label>
            <input type="date" name="start" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end" class="form-label">Ngày Kết Thúc</label>
            <input type="date" name="end" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Trạng Thái</label>
            <select name="is_active" class="form-control">
                <option value="1" selected>Kích Hoạt</option>
                <option value="0">Vô Hiệu Hóa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Tạo Voucher</button>
        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
