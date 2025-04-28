@extends('admin.layouts.master')
@section('title', 'Danh sách sản phẩm')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Danh sách sản phẩm</h4>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <form action="{{ route('admin.products.index') }}" method="GET" class="text-start">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
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
                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-sm-end">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-success waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                <i class="mdi mdi-plus me-1"></i>
                                Thêm
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive min-vh-100">
                    @if ($products->isNotEmpty())
                    <div class="min-vh-100">
                        <table class="table align-middle table-nowrap text-center dt-responsive nowrap w-100">
                            <thead class="">
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
                                            <img src="https://laravel.com/img/logomark.min.svg" alt="Image Default" style="height: 40px; width: 40px">
                                            @endif
                                        @elseif ($product->product_type === 'variant')
                                            @php
                                                $firstVariant = $product->variants->first();
                                                $variantImages = $firstVariant ? json_decode($firstVariant->images, true) : [];
                                            @endphp
                                            @if (!empty($variantImages))
                                                <img src="{{ asset('storage/' . $variantImages[0]) }}" alt="Ảnh biến thể" width="50">
                                            @else
                                            <img src="https://laravel.com/img/logomark.min.svg" alt="Image Default" style="height: 40px; width: 40px">
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
                    </div>

                    @else
                    <div class="min-vh-100 text-center align-content-center">
                        <h1 class="text-danger">Không có data !!!</h1>
                    </div>
                    @endif
                </div>

                @if ($products->isNotEmpty())
                <div class="row">
                    {{ $products->links('admin.layouts.components.pagination') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
