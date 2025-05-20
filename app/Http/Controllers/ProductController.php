<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Comment;
class ProductController extends Controller
{
    public function show($id)
    {
        $comments = Comment::where('product_id', $id)->with('user')->get();
        $product = Product::with('comments.user')->findOrFail($id);
        return view('products.show', compact('product', 'comments'));
    }

}
