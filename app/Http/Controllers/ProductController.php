<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Comment;

class ProductController extends Controller
{
    public function show($id)
    {
        $products = Product::paginate(12);
        $topProducts = Product::with('category', 'variants') // eager load nếu cần
            ->orderBy('views', 'desc') // hoặc tiêu chí nào đó để xếp hạng "top"
            ->paginate(12); // mỗi trang 12 sản phẩm

        return view('products.top', compact('topProducts'));
    }
}
