@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Tạo phiếu nhập kho</h1>

    {{-- Hiển thị lỗi nếu có --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.stock-imports.store') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn tạo phiếu nhập kho này không?');">
        @csrf

        <div class="mb-3">
            <label>Nhà cung cấp</label>
            <input type="text" name="supplier_name" class="form-control" placeholder="Nhập tên nhà cung cấp..." required>
        </div>

        <div class="mb-3">
            <label>Ngày nhập</label>
            <input type="date" name="import_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" class="form-control" rows="3" placeholder="Ghi chú (nếu có)..."></textarea>
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
                    <th>
                        <button type="button" class="btn btn-sm btn-success" onclick="addRow()">+</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][product_id]" class="form-control product-select" data-index="0" required onchange="updateVariants(this)">
                            <option value="">-- Chọn sản phẩm --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="items[0][product_variant_id]" class="form-control variant-select-0">
                            <option value="">-- Không có --</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[0][quantity]" class="form-control" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="items[0][price_import]" class="form-control" value="0" min="0" required>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Lưu phiếu nhập</button>
    </form>
</div>

{{-- Biến thể sản phẩm dạng JSON --}}
<script>
    const productVariants = @json(
        $products->mapWithKeys(function($product) {
            return [$product->id => $product->variants->map(function($variant) {
                return [
                    'id' => $variant->id,
                   'text' => ($variant->color->name ?? '') . ' / ' . ($variant->capacity->name ?? '')

                ];
            })];
        })
    );
</script>

{{-- Xử lý thêm dòng & lọc biến thể --}}
<script>
    let rowIndex = 1;

    function addRow() {
        const row = `
        <tr>
            <td>
                <select name="items[${rowIndex}][product_id]" class="form-control product-select" data-index="${rowIndex}" required onchange="updateVariants(this)">
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="items[${rowIndex}][product_variant_id]" class="form-control variant-select-${rowIndex}">
                    <option value="">-- Không có --</option>
                </select>
            </td>
            <td>
                <input type="number" name="items[${rowIndex}][quantity]" class="form-control" value="1" min="1" required>
            </td>
            <td>
                <input type="number" name="items[${rowIndex}][price_import]" class="form-control" value="0" min="0" required>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button>
            </td>
        </tr>`;
        document.querySelector('#import-items tbody').insertAdjacentHTML('beforeend', row);
        rowIndex++;
    }

    function updateVariants(selectElement) {
        const productId = selectElement.value;
        const index = selectElement.dataset.index;
        const variantSelect = document.querySelector(`.variant-select-${index}`);

        variantSelect.innerHTML = '<option value="">-- Không có --</option>';

        if (productVariants[productId]) {
            productVariants[productId].forEach(variant => {
                const option = document.createElement('option');
                option.value = variant.id;
                option.text = variant.text;
                variantSelect.appendChild(option);
            });
        }
    }
</script>
@endsection
