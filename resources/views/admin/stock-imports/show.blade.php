@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Chi tiết phiếu nhập</h1>

    <p><strong>Mã phiếu:</strong> {{ $import->code }}</p>
    <p><strong>Nhà cung cấp:</strong> {{ $import->supplier_name }}</p>
    <p><strong>Ngày nhập:</strong> {{ \Carbon\Carbon::parse($import->import_date)->format('d/m/Y') }}</p>
    <p><strong>Người tạo:</strong> {{ $import->user->name ?? '-' }}</p>
    <p><strong>Ghi chú:</strong> {{ $import->note }}</p>

    <h5>Danh sách sản phẩm nhập</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Biến thể</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($import->items as $item)
            <tr>
                <td>{{ $item->product->name ?? '-' }}</td>
                <td>
                    @if ($item->variant)
                        {{ $item->variant->color->name ?? '' }} / {{ $item->variant->capacity->name ?? '' }}
                    @else
                        Không có
                    @endif
                </td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price_import, 0, ',', '.') }}₫</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.stock-imports.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
