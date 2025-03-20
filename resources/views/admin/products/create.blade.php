@extends('admin.layouts.index')

@section('content')
<div class="bg-white rounded-lg shadow-md" style="margin-left: 50px;margin-right: 50px; border-radius: 2px">
    <div class="card-header mb-4" style="background:#ebe8ff;border-radius: 2px; height: 55px;">
        <h4 class="text-center" style="font-weight: 400; ">Thêm mới sản phẩm</h4>
    </div>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

    <div class="row justify-content-between text-left" style="margin-left: 50px">
        <div class="col-md-6">
            <!-- Tên sản phẩm -->
            <div class="form-group col-sm-10 flex-column d-flex">
                <label class="form-control-label px-3">Tên sản phẩm <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Danh mục sản phẩm -->
            <div class="form-group col-sm-10 flex-column d-flex">
                <label class="form-control-label px-3">Danh mục <span class="text-danger">*</span></label>
                <select name="category_id" class="w-full border border-gray-300 p-2 rounded">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            
            <!-- Giá sản phẩm -->
            <div class="form-group col-sm-10 flex-column d-flex">
                <label class="form-control-label px-3">Giá sản phẩm <span class="text-danger">*</span></label>
                <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="form-group col-sm-10 flex-column d-flex">
                <label class="form-control-label px-3">Mô tả <span class="text-danger">*</span></label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 p-2 rounded">{{ old('description') }}</textarea>
            </div>

            <!-- Ảnh sản phẩm -->
            <div class="form-group col-sm-10 flex-column d-flex">
                <label class="form-control-label px-3">Ảnh sản phẩm <span class="text-danger">*</span></label>
                <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Số lượng -->
            <div class="form-group col-sm-10 flex-column d-flex">
                <label class="form-control-label px-3">Số lượng <span class="text-danger">*</span></label>
                <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full border border-gray-300 p-2 rounded">
            </div>
        </div>

        <div class="col-md-6">
            <!-- Biến thể sản phẩm -->
            <div id="variants-wrapper" class="space-y-4">
                <h3 class="text-lg px-3">Biến thể sản phẩm</h3>

                <div class="variant-item grid grid-cols-3 gap-3 border p-3 rounded relative col-sm-8">
                    <button type="button" class="remove-variant absolute top-2 right-2 border-0 text-red-600 ont-semibold text-sm btn btn-primary" >
                        Xóa
                    </button>                    

                    <!-- Màu sắc -->
                    <div>
                        <label class="block font-medium text-gray-700">Màu sắc :</label>
                        <select name="variants[0][color_id]" class="w-full border border-gray-300 p-1 rounded">
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dung lượng -->
                    <div>
                        <label class="block font-medium text-gray-700">Dung lượng :</label>
                        <select name="variants[0][capacity_id]" class="w-full border border-gray-300 p-1 rounded">
                            @foreach ($capacities as $capacity)
                                <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Giá biến thể -->
                    <div>
                        <label class="block font-medium text-gray-700">Giá biến thể :</label>
                        <input type="number" name="variants[0][price]" class="w-full border border-gray-300 p-1 rounded">
                    </div>

                    <!-- Số lượng biến thể -->
                    <div>
                        <label class="block font-medium text-gray-700">Số lượng :</label>
                        <input type="number" name="variants[0][stock]" class="w-full border border-gray-300 p-1 rounded">
                    </div>
                </div>
            </div>

            <!-- Nút thêm biến thể -->
            <button type="button" id="add-variant" class="bg-gray-200 rounded hover:bg-gray-300 mt-4 mb-4 font-semibold btn btn-primary" style="width:100px;height:30px;font-size:12px">
            Thêm biến thể
            </button>

            <!-- Nút lưu -->
            <div class="text-right">
                <button type="submit" class="bg-green-200 px-6 py-2 rounded hover:bg-green-300 mt-4 font-semibold btn btn-primary" style="margin-right:80px;">
                Lưu sản phẩm
                </button>
            </div>
        </div>
    </div>
    </form>
</div>

<!-- Script để thêm/xoá biến thể -->
<script>
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
@endsection
