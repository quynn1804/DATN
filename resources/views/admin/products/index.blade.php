@extends('admin.layouts.index')

@section('content')
    <h1>Danh sách sản phẩm</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @if ($products->count())
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }} VND</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
    @if($product->status == 1)
        <span class="badge bg-success">Đang bán</span>
    @else
        <span class="badge bg-danger">Ngừng bán</span>
    @endif
</td>

   <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="50">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info">Xem</a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                    class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">Không có sản phẩm nào.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
