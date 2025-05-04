@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Chỉnh sửa phiếu nhập</h1>

    <form action="{{ route('admin.stock-imports.update', $import->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nhà cung cấp</label>
            <input type="text" name="supplier_name" class="form-control" value="{{ $import->supplier_name }}">
        </div>

        <div class="mb-3">
            <label>Ngày nhập</label>
            <input type="date" name="import_date" class="form-control" value="{{ $import->import_date }}">
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" class="form-control" rows="3">{{ $import->note }}</textarea>
        </div>

        <hr>
        <h5>Chi tiết sản phẩm nhập</h5>
        <table class="table table-bordered" id="import-items">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Biến thể</th>
                    <th>Số lượng</th>
                    <th>Giá nhập</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addRow()">+</button></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($import->items as $index => $item)
                <tr>
                    <td>
                        <select name="items[{{ $index }}][product_id]" class="form-control">
                            <option value="">-- Chọn --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="items[{{ $index }}][product_variant_id]" class="form-control">
                            <option value="">-- Không có --</option>
                            @foreach ($products as $product)
                                @foreach ($product->variants as $variant)
                                    <option value="{{ $variant->id }}" {{ $item->product_variant_id == $variant->id ? 'selected' : '' }}>
                                        {{ $product->name }} - {{ $variant->color->name ?? '' }} / {{ $variant->capacity->name ?? '' }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="items[{{ $index }}][quantity]" class="form-control" value="{{ $item->quantity }}"></td>
                    <td><input type="number" name="items[{{ $index }}][price_import]" class="form-control" value="{{ $item->price_import }}"></td>
                    <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Cập nhật phiếu nhập</button>
    </form>
</div>

<script>
    let rowIndex = {{ count($import->items) }};
    function addRow() {
        const row = `
        <tr>
            <td>
                <select name="items[${rowIndex}][product_id]" class="form-control">
                    <option value="">-- Chọn --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="items[${rowIndex}][product_variant_id]" class="form-control">
                    <option value="">-- Không có --</option>
                    @foreach ($products as $product)
                        @foreach ($product->variants as $variant)
                            <option value="{{ $variant->id }}">{{ $product->name }} - {{ $variant->color->name ?? '' }} / {{ $variant->capacity->name ?? '' }}</option>
                        @endforeach
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="items[${rowIndex}][quantity]" class="form-control" value="1" min="1"></td>
            <td><input type="number" name="items[${rowIndex}][price_import]" class="form-control" value="0" min="0"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
        </tr>`;
        document.querySelector('#import-items tbody').insertAdjacentHTML('beforeend', row);
        rowIndex++;
    }
</script>
@endsection
