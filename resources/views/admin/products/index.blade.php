@extends('admin.layouts.index')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="container">
    <h1 class="mb-4">Quản lý sản phẩm</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm theo tên sản phẩm...">
        </div>
        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="product_type" class="form-select">
                <option value="">Tất cả loại</option>
                <option value="single" {{ request('product_type') == 'single' ? 'selected' : '' }}>Sản phẩm đơn</option>
                <option value="variant" {{ request('product_type') == 'variant' ? 'selected' : '' }}>Có biến thể</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">Thêm sản phẩm</a>
        </div>
    </form>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Loại</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Không rõ' }}</td>
                    <td>
                        @if($product->product_type === 'single')
                            <span class="badge bg-primary">Sản phẩm đơn</span>
                        @else
                            <span class="badge bg-warning text-dark">Có biến thể</span>
                        @endif
                    </td>
                    <td>
                        @if($product->product_type === 'single')
                            {{ number_format($product->price, 0, ',', '.') }}₫
                        @else
                            @php
                                $minPrice = $product->variants->min('price');
                                $maxPrice = $product->variants->max('price');
                            @endphp
                            {{ number_format($minPrice, 0, ',', '.') }}₫ - {{ number_format($maxPrice, 0, ',', '.') }}₫
                        @endif
                    </td>
                    <td>
                        @if($product->product_type === 'single')
                            {{ $product->quantity }}
                        @else
                            {{ $product->variants->sum('stock') }}
                        @endif
                    </td>
                    <td>
                        @if ($product->product_type === 'single')
                        @php
                            $images = json_decode($product->images, true);
                        @endphp
                        @if (!empty($images))
                            <img src="{{ asset('storage/' . $images[0]) }}" alt="Ảnh" width="50">
                        @else
                            Không có ảnh
                        @endif
                    @elseif ($product->product_type === 'variant')
                        @php
                            $firstVariant = $product->variants->first();
                            $variantImages = $firstVariant ? json_decode($firstVariant->images, true) : [];
                        @endphp
                        @if (!empty($variantImages))
                            <img src="{{ asset('storage/' . $variantImages[0]) }}" alt="Ảnh biến thể" width="50">
                        @else
                            Không có ảnh
                        @endif
                    @endif
                    </td>
                    <td>
                        @if($product->status)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
