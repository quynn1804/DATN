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
        $product = Product::with(['variations.color', 'variations.capacity'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function getPrice(Request $request)
    {
        $product_id = $request->product_id;
        $color_id = $request->color_id;
        $capacity_id = $request->capacity_id;

        $variation = ProductVariation::where('product_id', $product_id)
            ->where('color_id', $color_id)
            ->where('capacity_id', $capacity_id)
            ->first();

        return response()->json([
            'price' => $variation ? number_format($variation->price, 0, ',', '.') . " VND" : "Không có giá",
            'stock' => $variation ? $variation->stock : 0
        ]);
    }
}


