@extends('admin.layouts.index')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="overflow-hidden card table-nowrap table-card">
                <div class="card-header d-flex justify-content-between align-items-center border-0">
                    <h5 class="mb-0">Danh sách sản phẩm</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm ms-auto">Thêm sản phẩm</a>
                </div>
                {{-- Thanh tìm kiếm và lọc danh mục --}}
                <form action="{{ route('admin.products.index') }}" method="GET" class="mb-3 px-3">
                    <div class="row">
                        <div class="col-md-3 ms-auto">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="category_id" class="form-control">
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
                

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="align-middle">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category ? $product->category->name : 'Không có' }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="avatar sm rounded-pill me-3" width="50">
                                        @else
                                            Không có ảnh
                                        @endif
                                    </td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <span class="badge {{ $product->status ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="drodown">
                                            <a data-bs-toggle="dropdown" href="#" class="btn p-1">
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.products.show', $product->id) }}" class="dropdown-item">Chi tiết</a>
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="dropdown-item">Sửa</a>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có sản phẩm nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body{margin-top:20px;
background:#eee;
}
.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.avatar.sm {
    width: 2.25rem;
    height: 2.25rem;
    font-size: .818125rem;
}
.table-nowrap .table td, .table-nowrap .table th {
    white-space: nowrap;
}
.table>:not(caption)>*>* {
    padding: 0.75rem 1.25rem;
    border-bottom-width: 1px;
}
table th {
    font-weight: 600;
    background-color: #eeecfd !important;
}
</style>
@endsection
