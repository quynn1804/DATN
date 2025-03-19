@extends('user.layouts.main')

@section('content')
<div class="container">
    <h2 class="text-center">🔥 Top 10 Sản Phẩm Được Yêu Thích Trong 30 Ngày Qua 🔥</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Hình Ảnh</th>
                <th>Giá</th>
                <th>Danh Mục</th>
                <th>Số Lượng Đã Bán</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" width="50"></td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $product->category->name ?? 'Chưa phân loại' }}</td>
                    <td>{{ $product->order_items_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
