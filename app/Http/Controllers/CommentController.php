<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($productId)
{
    $product = Product::with('comments.user')->findOrFail($productId);
    $comments = $product->comments()->latest()->get();

    return view('user.single-product', compact('product', 'comments'));
}
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        Comment::create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được thêm.');
    }
    public function show($id)
{
    $product = Product::with('comments.user')->findOrFail($id);
    return view('products.show', compact('product'));
}

}
