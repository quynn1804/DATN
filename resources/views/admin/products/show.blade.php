@extends('admin.layouts.index')
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Chi tiết sản phẩm</h1>

    <div class="mb-4">
        <strong>Tên sản phẩm:</strong> {{ $product->name }}
    </div>

    <div class="mb-4">
        <strong>Giá:</strong> {{ number_format($product->price) }} VND
    </div>

    <div class="mb-4">
        <strong>Mô tả:</strong> {{ $product->description }}
    </div>

    <div class="mb-4">
        <strong>Số lượng:</strong> {{ $product->quantity }}
    </div>

    <div class="mb-4">
        <strong>Ảnh sản phẩm:</strong>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32">
        @else
            Không có ảnh
        @endif
    </div>

    <h2 class="text-xl font-bold mt-6">Biến thể sản phẩm</h2>
    @foreach($product->variants as $variant)
        <div class="border p-4 mb-4">
            <div><strong>Màu sắc:</strong> {{ $variant->color->name }}</div>
            <div><strong>Dung lượng:</strong> {{ $variant->capacity->name }}</div>
            <div><strong>Giá:</strong> {{ number_format($variant->price) }} VND</div>
            <div><strong>Số lượng kho:</strong> {{ $variant->stock }}</div>
        </div>
    @endforeach

    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
</div>
@endsection
