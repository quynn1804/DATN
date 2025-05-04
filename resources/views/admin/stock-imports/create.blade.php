@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Tạo phiếu nhập kho</h1>

    <form action="{{ route('admin.stock-imports.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nhà cung cấp</label>
            <input type="text" name="supplier_name" class="form-control" placeholder="Nhập tên nhà cung cấp...">
        </div>

        <div class="mb-3">
            <label>Ngày nhập</label>
            <input type="date" name="import_date" class="form-control" value="{{ date('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
        </div>

        <hr>
        <h5>Chi tiết sản phẩm nhập</h5>
        <table class="table table-bordered" id="import-items">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Biến thể (nếu có)</th>
                    <th>Số lượng</th>
                    <th>Giá nhập</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addRow()">+</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][product_id]" class="form-control">
                            <option value="">-- Chọn --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="items[0][product_variant_id]" class="form-control">
                            <option value="">-- Không có --</option>
                            @foreach ($products as $product)
                                @foreach ($product->variants as $variant)
                                    <option value="{{ $variant->id }}">{{ $product->name }} - {{ $variant->color->name ?? '' }} / {{ $variant->capacity->name ?? '' }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="items[0][quantity]" class="form-control" value="1" min="1"></td>
                    <td><input type="number" name="items[0][price_import]" class="form-control" value="0" min="0"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Lưu phiếu nhập</button>
    </form>
</div>

<script>
    let rowIndex = 1;
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
