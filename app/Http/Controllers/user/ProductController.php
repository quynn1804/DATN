<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariationCombination;
use App\Models\ProductVariation;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['variants.color', 'variants.capacity'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function getPrice(Request $request)
    {
        $product_id = $request->product_id;
        $color_id = $request->color_id;
        $capacity_id = $request->capacity_id;

        $variant = ProductVariation::where('product_id', $product_id)
            ->where('color_id', $color_id)
            ->where('capacity_id', $capacity_id)
            ->first();

        return response()->json([
            'price' => $variant ? number_format($variant->price, 0, ',', '.') . " VND" : "Không có giá",
            'stock' => $variant ? $variant->stock : 0
        ]);
    }
}


