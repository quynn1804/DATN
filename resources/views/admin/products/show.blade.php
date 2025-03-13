@extends('admin.layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Tên sản phẩm:</strong> {{ $product->name }}
                    </div>

                    <div class="mb-3">
                        <strong>Giá:</strong>
                        <span class="text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                    </div>

                    <div class="mb-3">
                        <strong>Mô tả:</strong>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Số lượng:</strong> {{ $product->quantity }}
                    </div>

                    <div class="mb-3">
                        <strong>Trạng thái:</strong>
                        <span class="badge {{ $product->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <strong>Ảnh sản phẩm:</strong><br>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="150">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Biến thể sản phẩm --}}
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Biến thể sản phẩm</h5>
                </div>
                <div class="card-body">
                    @forelse($product->variants as $variant)
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div><strong>Màu sắc:</strong> {{ $variant->color->name }}</div>
                            <div><strong>Dung lượng:</strong> {{ $variant->capacity->name }}</div>
                            <div><strong>Giá:</strong>
                                <span class="text-danger fw-bold">{{ number_format($variant->price, 0, ',', '.') }} VND</span>
                            </div>
                            <div><strong>Số lượng kho:</strong> {{ $variant->stock }}</div>
                        </div>
                    @empty
                        <p class="text-muted">Không có biến thể nào.</p>
                    @endforelse
                </div>
            </div>

            {{-- Nút quay lại --}}
            <div class="text-end mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
