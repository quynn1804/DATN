@extends('admin.layouts.index')

@section('content')
<h2>Chi tiết bình luận</h2>
<p><strong>Sản phẩm:</strong> {{ $comment->product->name }}</p>
<p><strong>Người bình luận:</strong> {{ $comment->user->name }}</p>
<p><strong>Đánh giá:</strong> {{ $comment->rating }} ★</p>
<p><strong>Nội dung:</strong> {{ $comment->content }}</p>
<p><strong>Thời gian:</strong> {{ $comment->created_at }}</p>

<a href="{{ route('admin.comments.index') }}">Quay lại</a>
@endsection
