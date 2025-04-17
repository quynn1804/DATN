@extends('admin.layouts.master')
@section('title', 'Thêm mới')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Thêm voucher</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.vouchers.index') }}">Voucher</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>


        <form action="{{ route('admin.vouchers.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Mã Voucher
                                        </label>
                                        <input id="projectname-input" name="code" type="text" class="form-control" placeholder="Nhập mã code..." value="{{ old('code') }}" required>
                                        @error('code')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Loại giảm giá
                                        </label>
                                        <select name="discount_type" class="form-select" id="discount_type" required>
                                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Giảm theo số tiền</option>
                                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Giảm theo %</option>
                                        </select>
                                        @error('discount_type')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Giá trị giảm
                                        </label>
                                        <input type="number" name="discount_value" class="form-control" min="0" value="{{ old('discount_value') }}" required>
                                        @error('discount_value')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6" id="max_discount_group" style="display: none;">

                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Giảm giá tối đa (VND)
                                        </label>
                                        <input type="number" name="max_discount_amount" class="form-control" min="0" value="{{ old('max_discount_amount') }}">
                                        @error('max_discount_amount')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Giá trị đơn hàng tối thiểu
                                        </label>
                                        <input type="number" name="min_order_value" class="form-control" min="0" value="{{ old('min_order_value') }}">
                                        @error('min_order_value')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Ngày Bắt Đầu
                                        </label>
                                        <input type="date" name="start" class="form-control" value="{{ old('start') }}" required>
                                        @error('start')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            <span class="text-danger">*</span>
                                            Ngày Kết Thúc
                                        </label>
                                        <input type="date" name="end" class="form-control" value="{{ old('end') }}" required>
                                        @error('end')
                                        <div class="text-danger fst-italic">
                                            * {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Trạng Thái</label>
                                    <select name="is_active" class="form-select">
                                        <option value="1" {{ old('is_active', 1) == '1' ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Vô hiệu hóa</option>
                                    </select>
                                </div>
                            </div>



                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
