
@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1 class="my-4">Danh sách sản phẩm</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="80">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                @if($product->variants->count())
                    <tr>
                        <td colspan="7">
                            <strong>Biến thể:</strong>
                            <ul>
                                @foreach($product->variants as $variant)
                                    <li>
                                        Mã SP: {{ $product->id }}-{{ $variant->id }} |
                                        Màu: {{ $variant->color->name }} |
                                        Dung lượng: {{ $variant->capacity->name }} |
                                        Giá: {{ number_format($variant->price, 0, ',', '.') }} đ |
                                        Tồn kho: {{ $variant->stock }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
