@extends('admin.layouts.master')
@section('title', 'Sửa mã giảm giá')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Chỉnh sửa voucher</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.vouchers.index') }}">Voucher</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $voucher->code }}</li>
                </ol>
            </div>
        </div>


        <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST">
            @csrf
            @method('PUT')
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
                                        <input id="projectname-input" name="code" type="text" class="form-control" placeholder="Nhập mã code..." value="{{ old('code', $voucher->code) }}" required>
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
                                        <select id="discount_type" name="discount_type" class="form-select" required>
                                            <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Giảm số tiền</option>
                                            <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Giảm %</option>
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
                                        <input type="number" name="discount_value" class="form-control" min="0" value="{{ old('discount_value', $voucher->discount_value) }}" required>
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
                                        <input type="number" name="max_discount_amount" class="form-control" min="0" value="{{ old('max_discount_amount', $voucher->max_discount_amount) }}">
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
                                        <input type="number" name="min_order_value" class="form-control" min="0" value="{{ old('min_order_value', $voucher->min_order_value) }}">
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
                                        <input type="date" name="start" class="form-control" value="{{ old('start', $voucher->start) }}" required>
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
                                        <input type="date" name="end" class="form-control" value="{{ old('end', $voucher->end) }}" required>
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
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ $voucher->is_active ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="0" {{ !$voucher->is_active ? 'selected' : '' }}>Vô hiệu hóa</option>
                                    </select>
                                </div>
                            </div>



                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    document.addEventListener("DOMContentLoaded", function() {
        const discountType = document.getElementById("discount_type");
        const maxDiscountGroup = document.getElementById("max_discount_group");

        function toggleMaxDiscount() {
            if (discountType.value === "percentage") {
                maxDiscountGroup.style.display = "block";
            } else {
                maxDiscountGroup.style.display = "none";
            }
        }

        // Gọi khi trang tải xong
        toggleMaxDiscount();

        // Lắng nghe sự kiện thay đổi loại giảm giá
        discountType.addEventListener("change", toggleMaxDiscount);
    });

</script>
@endsection
