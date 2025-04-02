<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Color;
use App\Models\Capacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
           // tìm kiếm sp theo danh mục
           if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->with('category')->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', ['title' => 'Quản lý sản phẩm'], compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('variants.color', 'variants.capacity', 'category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $colors = Color::all();
        $capacities = Capacity::all();
        $categories = Category::all();

        return view('admin.products.create', compact('colors', 'capacities', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer',
            'variants.*.color_id' => 'required|exists:colors,id',
            'variants.*.capacity_id' => 'required|exists:capacities,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        foreach ($request->variants as $variant) {
            $product->variants()->create($variant);
        }

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    public function edit(Product $product)
    {
        $colors = Color::all();
        $capacities = Capacity::all();
        $categories = Category::all();
        $product->load('variants');

        return view('admin.products.edit', compact('product', 'colors', 'capacities', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
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
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

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

    public function topFavorites()
    {

        $topProducts = Product::topFavoriteProducts();
        return view('user.top_favorites', compact('topProducts'));
    }
}
