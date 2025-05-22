@extends('admin.layouts.master')
@section('title', 'Edit Product')

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

                <input type="hidden" name="product_type" value="variant">
                {{-- Loại sản phẩm bị bỏ rồi, không cần radio chọn loại nữa --}}
                {{-- <div class="mb-3"> ... </div> --}}

                {{-- Bỏ hẳn phần single-fields --}}
                {{-- <div id="single-fields"> ... </div> --}}

                {{-- Giữ lại phần variant fields --}}
                <div id="variant-fields">
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
                                    @if ($variant->images && is_array($variant->images))
                                        <div class="mt-2">
                                            @foreach ($variant->images as $img)
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
                            {{-- Nếu không có biến thể nào, có thể hiển thị rỗng hoặc thông báo --}}
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
                    <select name="status" class="form-select">
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
<script src="https://themesbrand.com/skote/layouts/assets/libs/tinymce/tinymce.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Không cần toggle loại sản phẩm nữa, vì chỉ có variant

        const variantContainer = document.getElementById('variant-container');
        const addVariantBtn = document.getElementById('add-variant');

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

        // Xóa biến thể đã có
        variantContainer.querySelectorAll('.remove-variant').forEach(function (btn) {
            btn.addEventListener('click', function () {
                variantContainer.removeChild(btn.closest('.variant-item'));
            });
        });
    });
</script>
@endsection
