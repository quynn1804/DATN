@extends('admin.layouts.index')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Chi tiết sản phẩm</h1>

    {{-- Thông tin sản phẩm --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <strong>Tên sản phẩm:</strong> {{ $product->name }}
        </div>

        <div class="mb-4">
            <strong>Giá:</strong> <span class="text-red-500 font-semibold">{{ number_format($product->price, 0, ',', '.') }} VND</span>
        </div>

        <div class="mb-4">
            <strong>Mô tả:</strong> <p class="text-gray-700">{{ $product->description }}</p>
        </div>

        <div class="mb-4">
            <strong>Số lượng:</strong> {{ $product->quantity }}
        </div>

        <div class="mb-4">
            <strong>Trạng thái:</strong>
            <span class="px-2 py-1 text-white rounded {{ $product->status ? 'bg-green-500' : 'bg-gray-500' }}">
                {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
            </span>
        </div>

        <div class="mb-4">
            <strong>Ảnh sản phẩm:</strong><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover border rounded-md shadow">
            @else
                <span class="text-gray-500">Không có ảnh</span>
            @endif
        </div>
    </div>

    {{-- Biến thể sản phẩm --}}
    <h2 class="text-xl font-bold mt-6">Biến thể sản phẩm</h2>
    @forelse($product->variants as $variant)
        <div class="border-l-4 border-blue-500 bg-gray-100 p-4 mb-4 rounded">
            <div><strong>Màu sắc:</strong> {{ $variant->color->name }}</div>
            <div><strong>Dung lượng:</strong> {{ $variant->capacity->name }}</div>
            <div><strong>Giá:</strong> <span class="text-red-500 font-semibold">{{ number_format($variant->price, 0, ',', '.') }} VND</span></div>
            <div><strong>Số lượng kho:</strong> {{ $variant->stock }}</div>
        </div>
    @empty
        <p class="text-gray-500">Không có biến thể nào.</p>
    @endforelse

    {{-- Nút quay lại --}}
    <div class="mt-6">
        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
            Quay lại danh sách
        </a>
    </div>
</div>
@endsection
