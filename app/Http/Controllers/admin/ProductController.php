<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Color;
use App\Models\Capacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants.color', 'variants.capacity')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function show($id)
{
    $product = Product::with('variants.color', 'variants.capacity')->findOrFail($id);
    return view('admin.products.show', compact('product'));
}

    public function create()
    {
        $colors = Color::all();
        $capacities = Capacity::all();
        return view('admin.products.create', compact('colors', 'capacities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer',
            'variants.*.color_id' => 'required|exists:colors,id',
            'variants.*.capacity_id' => 'required|exists:capacities,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|integer',
        ]);

        // Lưu ảnh nếu có
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Tạo sản phẩm
        $product = Product::create($validated);

        // Thêm các biến thể
        foreach ($request->variants as $variant) {
            $product->variants()->create($variant);
        }

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    public function edit(Product $product)
    {
        $colors = Color::all();
        $capacities = Capacity::all();
        $product->load('variants');
        return view('admin.products.edit', compact('product', 'colors', 'capacities'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image',
            'quantity' => 'required|integer',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.color_id' => 'required|exists:colors,id',
            'variants.*.capacity_id' => 'required|exists:capacities,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        // Cập nhật hoặc thêm biến thể
        foreach ($request->variants as $variant) {
            if (isset($variant['id'])) {
                $existingVariant = ProductVariant::find($variant['id']);
                $existingVariant->update($variant);
            } else {
                $product->variants()->create($variant);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật!');
    }

    public function destroy(Product $product)
    {
        // Xóa ảnh sản phẩm nếu có
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã bị xóa!');
    }

    public function destroyVariant($id)
    {
        $variant = ProductVariant::find($id);

        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'Biến thể không tồn tại.']);
        }

        $variant->delete();

        return response()->json(['success' => true, 'message' => 'Xóa biến thể thành công.']);
    }
}
