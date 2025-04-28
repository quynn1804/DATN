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
    <h1 class="mb-4 text-primary">Chỉnh sửa sản phẩm</h1>

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

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card border-info shadow">
            <div class="card-body bg-light">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại sản phẩm</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="product_type" id="type_single" value="single"
                            {{ old('product_type', $product->product_type) === 'single' ? 'checked' : '' }}>
                        <label class="form-check-label" for="type_single">Sản phẩm đơn</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="product_type" id="type_variant" value="variant"
                            {{ old('product_type', $product->product_type) === 'variant' || count($product->variants) > 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="type_variant">Có biến thể</label>
                    </div>
                </div>

                <div id="single-fields" style="display: {{ old('product_type', $product->product_type) === 'single' ? 'block' : 'none' }};">
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Hình ảnh sản phẩm</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        @if ($product->images && is_array(json_decode($product->images)))
                            <div class="mt-2">
                                @foreach (json_decode($product->images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Image" class="img-thumbnail me-2 mb-2" width="100">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div id="variant-fields" style="display: {{ old('product_type', $product->product_type) === 'variant' ? 'block' : 'none' }};">
                    <h5 class="mt-4">Biến thể sản phẩm</h5>
                    <div id="variant-container">
                        @forelse($product->variants as $index => $variant)
                        <div class="variant-item border p-3 rounded mb-3 bg-white shadow-sm">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">Màu sắc</label>
                                    <select name="variants[{{ $index }}][color_id]" class="form-select">
                                        <option value="">-- Chọn màu --</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Dung lượng</label>
                                    <select name="variants[{{ $index }}][capacity_id]" class="form-select">
                                        <option value="">-- Chọn dung lượng --</option>
                                        @foreach($capacities as $capacity)
                                            <option value="{{ $capacity->id }}" {{ $variant->capacity_id == $capacity->id ? 'selected' : '' }}>{{ $capacity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Giá</label>
                                    <input type="number" name="variants[{{ $index }}][price]" class="form-control" value="{{ $variant->price }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Số lượng</label>
                                    <input type="number" name="variants[{{ $index }}][stock]" class="form-control" value="{{ $variant->stock }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ảnh</label>
                                    <input type="file" name="variants[{{ $index }}][images][]" class="form-control" multiple>
                                    @if ($variant->images && is_array(json_decode($variant->images)))
                                        <div class="mt-2">
                                            @foreach (json_decode($variant->images) as $img)
                                                <img src="{{ asset('storage/' . $img) }}" alt="Variant Image" class="img-thumbnail me-2 mb-2" width="80">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                                </div>
                            </div>
                        </div>
                        @empty
                            <!-- Trường hợp không có biến thể nào, hiển thị 1 mẫu rỗng -->
                        @endforelse
                    </div>
                    <button type="button" id="add-variant" class="btn btn-outline-primary">+ Thêm biến thể</button>
                </div>

                <div class="mb-3 mt-4">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status" id="status" class="form-select">
                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<!--tinymce js-->
<script src="https://themesbrand.com/skote/layouts/assets/libs/tinymce/tinymce.min.js"></script>

{{-- <script>
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



    function removeVariant(button) {
        let variantContainer = button.closest('.border.p-4');
        if (variantContainer) {
            variantContainer.remove();
        }
    }

    function addVariant() {
        let variantsContainer = document.getElementById('variants-container');
        let index = variantsContainer.children.length; // Đếm số biến thể hiện có

        let variantHtml = `
            <div class="border p-4 relative min-w-[300px]">
                <button type="button" class="absolute top-2 right-2 text-black hover:text-red-600 font-bold text-xl" onclick="removeVariant(this)">❌</button>

                <div class="space-y-2">
                    <input type="hidden" name="variants[${index}][id]" value="">

                    <div>
                        <label class="block text-gray-700">Màu sắc</label>
                        <select name="variants[${index}][color_id]" class="w-full border rounded p-2">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Dung lượng</label>
                        <select name="variants[${index}][capacity_id]" class="w-full border rounded p-2">
                            @foreach($capacities as $capacity)
                                <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Giá biến thể</label>
                        <input type="text" name="variants[${index}][price]" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-gray-700">Số lượng kho</label>
                        <input type="number" name="variants[${index}][stock]" class="w-full border rounded p-2">
                    </div>
                </div>
            </div>
        `;

        variantsContainer.insertAdjacentHTML('beforeend', variantHtml);
    }

    function removeVariant(button) {
        let variantContainer = button.closest('.border.p-4');
        if (variantContainer) {
            variantContainer.remove();
        }
    }

</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSingle = document.getElementById('type_single');
        const typeVariant = document.getElementById('type_variant');
        const singleFields = document.getElementById('single-fields');
        const variantFields = document.getElementById('variant-fields');

        function toggleFields() {
            singleFields.style.display = typeSingle.checked ? 'block' : 'none';
            variantFields.style.display = typeVariant.checked ? 'block' : 'none';
        }

        typeSingle.addEventListener('change', toggleFields);
        typeVariant.addEventListener('change', toggleFields);

        toggleFields();

        const variantContainer = document.getElementById('variant-container');
        const addVariantBtn = document.getElementById('add-variant');
        const removeVariantBtns = document.querySelectorAll('.remove-variant');

        addVariantBtn.addEventListener('click', function () {
            const index = variantContainer.children.length;
            const newVariant = document.createElement('div');
            newVariant.classList.add('variant-item', 'border', 'p-3', 'rounded', 'mb-3', 'bg-white', 'shadow-sm');
            newVariant.innerHTML = `
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Màu sắc</label>
                        <select name="variants[${index}][color_id]" class="form-select">
                            <option value="">-- Chọn màu --</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Dung lượng</label>
                        <select name="variants[${index}][capacity_id]" class="form-select">
                            <option value="">-- Chọn dung lượng --</option>
                            @foreach($capacities as $capacity)
                                <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Giá</label>
                        <input type="number" name="variants[${index}][price]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Số lượng</label>
                        <input type="number" name="variants[${index}][stock]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ảnh</label>
                        <input type="file" name="variants[${index}][images][]" class="form-control" multiple>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                    </div>
                </div>
            `;
            variantContainer.appendChild(newVariant);
            newVariant.querySelector('.remove-variant').addEventListener('click', function () {
                variantContainer.removeChild(newVariant);
            });
        });

        removeVariantBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                variantContainer.removeChild(btn.closest('.variant-item'));
            });
        });
    });
</script>
@endsection
