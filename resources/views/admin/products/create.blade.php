@extends('admin.layouts.master')
@section('title', 'New Product')

@section('style')
<style>
    #projectlogo-img {
        width: 6rem;
    }
    .h-screen {
        height: 100%;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Thêm sản phẩm mới </h1>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">← Quay lại danh sách</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-info shadow">
            <div class="card-body bg-light">

                <div class="mb-3">
                    <label for="name" class="form-label"> <span class="text-danger">*</span>Tên sản phẩm</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label"> <span class="text-danger">*</span>Danh mục</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="product_type" value="variant">
                {{-- Bỏ radio loại sản phẩm --}}
                {{-- Bỏ phần single-fields --}}

                {{-- Chỉ giữ variant-fields và hiển thị luôn --}}
                <div id="variant-fields" style="display: block;">
                    <h5 class="mt-4">Biến thể sản phẩm</h5>
                    <div id="variant-container">
                        <div class="variant-item border p-3 rounded mb-3 bg-white shadow-sm">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Màu sắc</label>
                                    <select name="variants[0][color_id]" class="form-select" required>
                                        <option value="">-- Chọn màu --</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Dung lượng</label>
                                    <select name="variants[0][capacity_id]" class="form-select" required>
                                        <option value="">-- Chọn dung lượng --</option>
                                        @foreach($capacities as $capacity)
                                            <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Giá</label>
                                    <input type="number" name="variants[0][price]" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Số lượng</label>
                                    <input type="number" name="variants[0][stock]" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"> <span class="text-danger">*</span>Ảnh</label>
                                    <input type="file" name="variants[0][images][]" class="form-control" multiple required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-variant" class="btn btn-outline-primary">+ Thêm biến thể</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                         <span class="text-danger">*</span>
                        Mô Tả
                    </label>
                    <textarea id="elm1" name="description">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger fst-italic">*{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status"  class="form-select">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" >Ẩn</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<!-- Giữ nguyên phần script thêm/xóa biến thể như cũ -->
<script src="https://themesbrand.com/skote/layouts/assets/libs/tinymce/tinymce.min.js"></script>
<script>
    if (document.getElementById("elm1")) {
        tinymce.init({
            selector: "textarea#elm1",
            height: 350,
            plugins: [
                "advlist","autolink","lists","link","charmap","preview",
                "anchor","searchreplace","visualblocks","code","fullscreen",
                "insertdatetime","media","table","help","wordcount"
            ],
            toolbar: "undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help",
            content_style: 'body { font-family:"Poppins",sans-serif; font-size:16px }',
        });
    }

    let variantIndex = 1;

    const variantContainer = document.getElementById('variant-container');
    const addVariantBtn = document.getElementById('add-variant');

    addVariantBtn.addEventListener('click', function () {
        const newItem = document.createElement('div');
        newItem.className = 'variant-item border p-3 rounded mb-3 bg-white shadow-sm';
        newItem.innerHTML = `
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">Màu sắc</label>
                    <select name="variants[${variantIndex}][color_id]" class="form-select" required>
                        <option value="">-- Chọn màu --</option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Dung lượng</label>
                    <select name="variants[${variantIndex}][capacity_id]" class="form-select" required>
                        <option value="">-- Chọn dung lượng --</option>
                        @foreach($capacities as $capacity)
                            <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Giá</label>
                    <input type="number" name="variants[${variantIndex}][price]" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Số lượng</label>
                    <input type="number" name="variants[${variantIndex}][stock]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ảnh</label>
                    <input type="file" name="variants[${variantIndex}][images][]" class="form-control" multiple required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                </div>
            </div>
        `;
        variantContainer.appendChild(newItem);
        variantIndex++;
    });

    variantContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.variant-item').remove();
        }
    });
</script>
@endsection
