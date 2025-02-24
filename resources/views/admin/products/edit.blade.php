@extends('admin.layouts.index')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Chỉnh sửa sản phẩm</h1>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Giá</label>
                <input type="text" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Mô tả</label>
                <textarea name="description" class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Số lượng</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Ảnh sản phẩm</label>
                <input type="file" name="image" class="w-full border rounded p-2">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 mt-2">
                @endif
            </div>

            <h2 class="text-xl font-bold mt-6">Biến thể sản phẩm</h2>
            <div class="flex space-x-4 overflow-x-auto py-4">
                @foreach($product->variants as $index => $variant)
                    <div class="border p-4 relative min-w-[300px]">
                        <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">

                        <!-- Nút xóa với dấu ❌ -->
                        <button type="button" class="absolute top-2 right-2 text-black hover:text-red-600 font-bold text-xl" onclick="removeVariant({{ $variant->id }})">❌</button>

                        <div class="space-y-2">
                            <div>
                                <label class="block text-gray-700">Màu sắc</label>
                                <select name="variants[{{ $index }}][color_id]" class="w-full border rounded p-2">
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700">Dung lượng</label>
                                <select name="variants[{{ $index }}][capacity_id]" class="w-full border rounded p-2">
                                    @foreach($capacities as $capacity)
                                        <option value="{{ $capacity->id }}" {{ $variant->capacity_id == $capacity->id ? 'selected' : '' }}>{{ $capacity->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700">Giá biến thể</label>
                                <input type="text" name="variants[{{ $index }}][price]" value="{{ $variant->price }}" class="w-full border rounded p-2">
                            </div>

                            <div>
                                <label class="block text-gray-700">Số lượng kho</label>
                                <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" class="w-full border rounded p-2">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">Cập nhật sản phẩm</button>
        </form>
    </div>
@endsection

<script>
    function removeVariant(variantId) {
        if (confirm('Bạn có chắc chắn muốn xóa biến thể này?')) {
            fetch(`/admin/products/variant/${variantId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Xóa biến thể thành công!');
                    location.reload();
                } else {
                    alert('Xóa thất bại: ' + (data.message || 'Đã có lỗi xảy ra.'));
                }
            })
            .catch(error => {
                alert('Đã xảy ra lỗi khi xóa biến thể.');
                console.error('Error:', error);
            });
        }
    }
</script>
