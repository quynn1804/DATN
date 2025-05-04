<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockImport;
use App\Models\StockImportItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StockImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imports = StockImport::with('user')->latest()->paginate(10);
        return view('admin.stock-imports.index', compact('imports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('variants')->get();
        return view('admin.stock-imports.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'import_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_variant_id' => 'nullable|exists:product_variants,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price_import' => 'required|numeric|min:0',
        ]);

        // Tạo phiếu nhập
        $import = StockImport::create([
            'code' => 'PN-' . strtoupper(Str::random(6)),
            'supplier_name' => $request->supplier_name,
            'import_date' => $request->import_date,
            'note' => $request->note,
            'created_by' => Auth::id(),
        ]);

        // Tạo các dòng chi tiết
        foreach ($request->items as $item) {
            $import->items()->create([
                'product_id' => $item['product_id'] ?? null,
                'product_variant_id' => $item['product_variant_id'] ?? null,
                'quantity' => $item['quantity'],
                'price_import' => $item['price_import'],
            ]);

            // Cập nhật tồn kho
            if ($item['product_variant_id']) {
                $variant = ProductVariant::find($item['product_variant_id']);
                $variant->stock += $item['quantity'];
                $variant->save();
            } elseif ($item['product_id']) {
                $product = Product::find($item['product_id']);
                $product->quantity += $item['quantity'];
                $product->save();
            }
        }

        return redirect()->route('admin.stock-imports.index')->with('success', 'Tạo phiếu nhập thành công.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $import = StockImport::with('items.product', 'items.variant', 'user')->findOrFail($id);
        return view('admin.stock-imports.show', compact('import'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $import = StockImport::with('items.product', 'items.variant')->findOrFail($id);
    $products = Product::with('variants')->get(); // Lấy tất cả sản phẩm và biến thể
    return view('admin.stock-imports.edit', compact('import', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'import_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_variant_id' => 'nullable|exists:product_variants,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price_import' => 'required|numeric|min:0',
        ]);

        $import = StockImport::findOrFail($id);
        $import->update([
            'supplier_name' => $request->supplier_name,
            'import_date' => $request->import_date,
            'note' => $request->note,
        ]);

        // Xóa các items cũ trước khi cập nhật lại
        $import->items()->delete();

        // Thêm các items mới
        foreach ($request->items as $item) {
            $import->items()->create([
                'product_id' => $item['product_id'] ?? null,
                'product_variant_id' => $item['product_variant_id'] ?? null,
                'quantity' => $item['quantity'],
                'price_import' => $item['price_import'],
            ]);

            // Cập nhật tồn kho
            if ($item['product_variant_id']) {
                $variant = ProductVariant::find($item['product_variant_id']);
                $variant->stock += $item['quantity'];
                $variant->save();
            } elseif ($item['product_id']) {
                $product = Product::find($item['product_id']);
                $product->quantity += $item['quantity'];
                $product->save();
            }
        }

        return redirect()->route('admin.stock-imports.index')->with('success', 'Cập nhật phiếu nhập thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $import = StockImport::findOrFail($id);

        // Cập nhật lại tồn kho, giảm bớt số lượng đã nhập
        foreach ($import->items as $item) {
            if ($item->product_variant_id) {
                $variant = ProductVariant::find($item->product_variant_id);
                $variant->stock -= $item->quantity;
                $variant->save();
            } elseif ($item->product_id) {
                $product = Product::find($item->product_id);
                $product->quantity -= $item->quantity;
                $product->save();
            }
        }

        // Xóa các chi tiết nhập kho
        $import->items()->delete();

        // Xóa phiếu nhập
        $import->delete();

        return redirect()->route('admin.stock-imports.index')->with('success', 'Đã xóa phiếu nhập thành công.');

    }
}
