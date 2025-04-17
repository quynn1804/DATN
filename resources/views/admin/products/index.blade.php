@extends('admin.layouts.master')
@section('title', 'Danh sách sản phẩm')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Danh sách sản phẩm</h4>

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
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
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
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>{{ $product->name }}</td>

                                    <td>{{ $product->category ? $product->category->name : 'Không có' }}</td>

                                    <td>
                                        @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="avatar sm rounded-pill me-3" width="50">
                                        @else
                                        <img src="https://laravel.com/img/logomark.min.svg" alt="Image Default" style="height: 40px; width: 40px">
                                        @endif
                                    </td>

                                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                    <td>{{ $product->quantity }}</td>

                                    <td>
                                        <span class="badge font-size-12 p-2 {{ $product->status ? 'bg-success' : ' bg-danger' }}">
                                            {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit">
                                            </i>

                                        </a>
                                    </td>
                                </tr>
                                @endforeach
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
