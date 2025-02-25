
@extends('admin.layouts.index')


@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Thêm mới sản phẩm</h2>

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

        <!-- Tên sản phẩm -->
        <div>
            <label class="block font-medium text-gray-700">Tên sản phẩm</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <!-- Giá sản phẩm -->
        <div>
            <label class="block font-medium text-gray-700">Giá sản phẩm</label>
            <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <!-- Mô tả sản phẩm -->
        <div>
            <label class="block font-medium text-gray-700">Mô tả</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 p-2 rounded">{{ old('description') }}</textarea>
        </div>

        <!-- Ảnh sản phẩm -->
        <div>
            <label class="block font-medium text-gray-700">Ảnh sản phẩm</label>
            <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <!-- Số lượng -->
        <div>
            <label class="block font-medium text-gray-700">Số lượng</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <!-- Biến thể sản phẩm -->
        <div id="variants-wrapper" class="space-y-4">
            <h3 class="text-xl font-semibold">Biến thể sản phẩm</h3>

            <div class="variant-item grid grid-cols-4 gap-4 border p-4 rounded relative">
                <!-- Nút xoá biến thể -->
                <button type="button" class="remove-variant absolute top-2 right-2 text-black hover:text-red-700 font-bold text-lg">
                    ❌
                </button>

                <!-- Màu sắc -->
                <div>
                    <label class="block font-medium text-gray-700">Màu sắc</label>
                    <select name="variants[0][color_id]" class="w-full border border-gray-300 p-2 rounded">
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dung lượng -->
                <div>
                    <label class="block font-medium text-gray-700">Dung lượng</label>
                    <select name="variants[0][capacity_id]" class="w-full border border-gray-300 p-2 rounded">
                        @foreach ($capacities as $capacity)
                            <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Giá biến thể -->
                <div>
                    <label class="block font-medium text-gray-700">Giá biến thể</label>
                    <input type="number" name="variants[0][price]" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <!-- Số lượng biến thể -->
                <div>
                    <label class="block font-medium text-gray-700">Số lượng</label>
                    <input type="number" name="variants[0][stock]" class="w-full border border-gray-300 p-2 rounded">
                </div>
            </div>
        </div>

        <!-- Nút thêm biến thể -->
        <button type="button" id="add-variant" class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300 mt-4 font-semibold">
            ➕ Thêm biến thể
        </button>

        <!-- Nút lưu -->
        <div>
            <button type="submit" class="bg-green-200 text-black px-6 py-2 rounded hover:bg-green-300 font-semibold">
                💾 Lưu sản phẩm
            </button>
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
            <div class="variant-item grid grid-cols-4 gap-4 border p-4 rounded relative">
                <button type="button" class="remove-variant absolute top-2 right-2 text-black hover:text-red-700 font-bold text-lg">❌</button>

                <div>
                    <label class="block font-medium text-gray-700">Màu sắc</label>
                    <select name="variants[${variantIndex}][color_id]" class="w-full border border-gray-300 p-2 rounded">
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Dung lượng</label>
                    <select name="variants[${variantIndex}][capacity_id]" class="w-full border border-gray-300 p-2 rounded">
                        @foreach ($capacities as $capacity)
                            <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Giá biến thể</label>
                    <input type="number" name="variants[${variantIndex}][price]" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Số lượng</label>
                    <input type="number" name="variants[${variantIndex}][stock]" class="w-full border border-gray-300 p-2 rounded">
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
