<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'product'])->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::with(['user', 'product'])->findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    public function store(Request $request)
    {
        // dd($request->all()); // Kiểm tra dữ liệu gửi lên có đúng không

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


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được xóa.');
    }
}
