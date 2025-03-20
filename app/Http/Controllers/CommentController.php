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

    public function store(Request $request, $orderId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'content' => 'required|string',
        'product_id' => 'required|exists:products,id',
    ]);

    // Kiểm tra xem người dùng đã bình luận trong đơn hàng này chưa
    $hasCommented = Comment::where('user_id', Auth::id())
        ->where('product_id', $request->product_id)
        ->whereHas('product.orderDetails.order', function ($query) use ($orderId) {
            $query->where('id', $orderId);
        })
        ->exists();

    if ($hasCommented) {
        return redirect()->back()->with('error', 'Bạn đã bình luận cho đơn hàng này rồi.');
    }

    // Lưu bình luận mới
    Comment::create([
        'product_id' => $request->product_id,
        'user_id' => Auth::id(),
        'rating' => $request->rating,
        'content' => $request->content,
    ]);

    return redirect()->route('products.show', $request->product_id)->with('success', 'Bình luận đã được thêm.');
}

    public function show($id)
    {
        $product = Product::with('comments.user')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
