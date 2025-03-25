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


public function store(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'content' => 'required|string',
    ]);

    // Kiểm tra xem bình luận đã tồn tại chưa
    $existingComment = Comment::where('order_id', $request->order_id)
        ->where('product_id', $request->product_id)
        ->where('user_id', auth()->id())
        ->first();

    if ($existingComment) {
        return response()->json(['message' => 'Bạn đã bình luận cho sản phẩm này trong đơn hàng này.'], 400);
    }

    // Lưu bình luận mới
    Comment::create([
        'order_id' => $request->order_id,
        'product_id' => $request->product_id,
        'user_id' => auth()->id(),
        'rating' => $request->rating,
        'content' => $request->content,
    ]);

    return response()->json(['message' => 'Bình luận đã được thêm thành công!']);
}
    public function show($id)
    {
        $product = Product::with('comments.user')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
