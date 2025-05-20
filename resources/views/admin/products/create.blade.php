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
{{-- <div class="mb-3">
    <label class="form-label">
         <span class="text-danger">*</span>
        Mô Tả
    </label>
    <textarea id="elm1" name="description">
    {{ old('description') }}
    </textarea>
    @error('description')
    <div class="text-danger fst-italic">*{{ $message }}</div>
    @enderror
</div> --}}
<div class="container">
    <h1 class="mb-4 text-primary">Thêm sản phẩm mới</h1>

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

                <div class="mb-3">
                    <label class="form-label"> <span class="text-danger">*</span>Loại sản phẩm</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="product_type" id="type_single" value="single" {{ old('product_type', 'single') === 'single' ? 'checked' : '' }}>
                        <label class="form-check-label" for="type_single">Sản phẩm đơn</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="product_type" id="type_variant" value="variant" {{ old('product_type') === 'variant' ? 'checked' : '' }}>
                        <label class="form-check-label" for="type_variant">Có biến thể</label>
                    </div>
                </div>

                <div id="single-fields" style="display: {{ old('product_type', 'single') === 'single' ? 'block' : 'none' }};">
                    <div class="mb-3">
                        <label class="form-label"> <span class="text-danger">*</span>Màu sắc</label>
                        <select name="color_id" class="form-select">
                            <option value="">-- Chọn màu --</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"> <span class="text-danger">*</span>Dung lượng</label>
                        <select name="capacity_id" class="form-select">
                            <option value="">-- Chọn dung lượng --</option>
                            @foreach($capacities as $capacity)
                                <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label"> <span class="text-danger">*</span>Giá</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label"> <span class="text-danger">*</span>Số lượng</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label"> <span class="text-danger">*</span>Hình ảnh sản phẩm</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                    </div>
                </div>

                <div id="variant-fields" style="display: {{ old('product_type') === 'variant' ? 'block' : 'none' }};">
                    <h5 class="mt-4">Biến thể sản phẩm</h5>
                    <div id="variant-container">
                        <div class="variant-item border p-3 rounded mb-3 bg-white shadow-sm">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Màu sắc</label>
                                    <select name="variants[0][color_id]" class="form-select">
                                        <option value="">-- Chọn màu --</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Dung lượng</label>
                                    <select name="variants[0][capacity_id]" class="form-select">
                                        <option value="">-- Chọn dung lượng --</option>
                                        @foreach($capacities as $capacity)
                                            <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Giá</label>
                                    <input type="number" name="variants[0][price]" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"> <span class="text-danger">*</span>Số lượng</label>
                                    <input type="number" name="variants[0][stock]" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"> <span class="text-danger">*</span>Ảnh</label>
                                    <input type="file" name="variants[0][images][]" class="form-control" multiple>
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
                    <textarea id="elm1" name="description">
                    {{ old('description') }}
                    </textarea>
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
<!--tinymce js-->
<script src="https://themesbrand.com/skote/layouts/assets/libs/tinymce/tinymce.min.js"></script>

<script>
    const previewImage = (event) => {
        const img = document.getElementById("projectlogo-img");
        img.src = URL.createObjectURL(event.target.files[0]);

        $("#projectlogo-img").addClass("h-screen");
    }

    $("#elm1") &&
        tinymce.init({
            selector: "textarea#elm1"
            , height: 350
            , plugins: [
                "advlist"
                , "autolink"
                , "lists"
                , "link"
                , "image"
                , "charmap"
                , "preview"
                , "anchor"
                , "searchreplace"
                , "visualblocks"
                , "code"
                , "fullscreen"
                , "insertdatetime"
                , "media"
                , "table"
                , "help"
                , "wordcount"
            , ]
            , toolbar: "undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help"
            , content_style: 'body { font-family:"Poppins",sans-serif; font-size:16px }'
        , });



    let variantIndex = 1;

    // Thêm biến thể mới
    document.getElementById('add-variant').addEventListener('click', function() {
        const variantsWrapper = document.getElementById('variants-wrapper');
        const variantHtml = `
        <div class="variant-item grid grid-cols-3 gap-3 border p-3 rounded relative col-sm-8">
            <button type="button" class="remove-variant absolute top-2 right-2 border-0 text-red-600 ont-semibold text-sm btn btn-primary">Xóa</button>

            <div>
                <label class="block font-medium text-gray-700">Màu sắc</label>
                <select name="variants[${variantIndex}][color_id]" class="w-full border border-gray-300 p-1 rounded">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Dung lượng</label>
                <select name="variants[${variantIndex}][capacity_id]" class="w-full border border-gray-300 p-1 rounded">
                    @foreach ($capacities as $capacity)
                        <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Giá biến thể</label>
                <input type="number" name="variants[${variantIndex}][price]" class="w-full border border-gray-300 p-1 rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Số lượng</label>
                <input type="number" name="variants[${variantIndex}][stock]" class="w-full border border-gray-300 p-1 rounded">
            </div>
        </div>
    `;
        variantsWrapper.insertAdjacentHTML('beforeend', variantHtml);
        variantIndex++;
    });

    // Xoá biến thể
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-variant')) {
            const variantItem = e.target.closest('.variant-item');
            variantItem.remove();
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSingle = document.getElementById('type_single');
        const typeVariant = document.getElementById('type_variant');
        const singleFields = document.getElementById('single-fields');
        const variantFields = document.getElementById('variant-fields');

        function toggleFields() {
            if (typeSingle.checked) {
                singleFields.style.display = 'block';
                variantFields.style.display = 'none';
            } else {
                singleFields.style.display = 'none';
                variantFields.style.display = 'block';
            }
        }

        typeSingle.addEventListener('change', toggleFields);
        typeVariant.addEventListener('change', toggleFields);

        toggleFields();

        const variantContainer = document.getElementById('variant-container');
        const addVariantBtn = document.getElementById('add-variant');

        let variantIndex = 1;

        addVariantBtn.addEventListener('click', function () {
            const newItem = document.createElement('div');
            newItem.className = 'variant-item border p-3 rounded mb-3 bg-white shadow-sm';
            newItem.innerHTML = `
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Màu sắc</label>
                        <select name="variants[${variantIndex}][color_id]" class="form-select">
                            <option value="">-- Chọn màu --</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Dung lượng</label>
                        <select name="variants[${variantIndex}][capacity_id]" class="form-select">
                            <option value="">-- Chọn dung lượng --</option>
                            @foreach($capacities as $capacity)
                                <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Giá</label>
                        <input type="number" name="variants[${variantIndex}][price]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Số lượng</label>
                        <input type="number" name="variants[${variantIndex}][stock]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ảnh</label>
                        <input type="file" name="variants[${variantIndex}][images][]" class="form-control" multiple>
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
    });
</script>
@endsection
