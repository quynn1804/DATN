@extends('admin.layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: black">Chi tiết sản phẩm</h1>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">← Quay lại danh sách</a>

    <div class="card border-info shadow">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color:rgb(227, 119, 137)">
            <strong>{{ $product->name }}</strong>
            @if($product->status)
                <span class="badge bg-success">Hiển thị</span>
            @else
                <span class="badge bg-secondary">Ẩn</span>
            @endif
        </div>
        <div class="card-body bg-light">
            <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'Không có' }}</p>
            <p><strong>Loại sản phẩm:</strong>
                @if($product->product_type === 'single')
                    <span class="badge bg-primary">Sản phẩm đơn</span>
                @else
                    <span class="badge bg-warning text-dark">Có biến thể</span>
                @endif
            </p>
            <p><strong>Mô tả:</strong></p>
            <div class=" p-3 rounded border" style="background-color:rgb(222, 213, 213)">{!! nl2br(e($product->description)) !!}</div>

            <div class="mt-3">
                <strong>Hình ảnh:</strong><br>
                @if ($product->images)
                    @foreach (json_decode($product->images) as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Ảnh sản phẩm" style="max-width: 150px;" class="img-thumbnail me-2 mb-2">
                    @endforeach
                @else
                    <p>Không có hình ảnh.</p>
                @endif
            </div>

            @if ($product->product_type === 'single')
                <hr>
                <p><strong>Giá:</strong> <span class="text-danger">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span></p>
                <p><strong>Số lượng:</strong> <span class="text-success">{{ $product->quantity }}</span></p>
            @else
                <hr>
                <h5 class="text-primary">Danh sách biến thể</h5>
                @if ($product->variants->count() > 0)
                    <table class="table table-bordered table-hover bg-white">
                        <thead class="table-info">
                            <tr>
                                <th>Màu sắc</th>
                                <th>Dung lượng</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Mô tả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->color->name ?? 'N/A' }}</td>
                                    <td>{{ $variant->capacity->name ?? 'N/A' }}</td>
                                    <td><span class="text-danger">{{ number_format($variant->price, 0, ',', '.') }} VNĐ</span></td>
                                    <td><span class="text-success">{{ $variant->stock }}</span></td>
                                    <td>{!! nl2br(e($variant->description ?? '-')) !!}</td>
                                    <td>
                                        @php
                                            $variantImages = json_decode($variant->images, true);
                                        @endphp

                                        @if (!empty($variantImages))
                                            @foreach ($variantImages as $img)
                                                <img src="{{ asset('storage/' . $img) }}" alt="Ảnh biến thể" style="width: 80px;" class="img-thumbnail me-1 mb-1">
                                            @endforeach
                                        @else
                                            <span>Không có ảnh</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Không có biến thể nào cho sản phẩm này.</p>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
