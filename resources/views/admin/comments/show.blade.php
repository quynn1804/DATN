@extends('admin.layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12"> <!-- Chỉnh chiều rộng bằng với danh sách -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Chi tiết bình luận</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Sản phẩm:</strong> {{ $comment->product->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Người bình luận:</strong> {{ $comment->user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Đánh giá:</strong> <span class="text-warning">{{ $comment->rating }} ★</span>
                    </div>
                    <div class="mb-3">
                        <strong>Nội dung:</strong>
                        <p class="border rounded p-2 bg-light">{{ $comment->content }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Thời gian:</strong> {{ $comment->created_at }}
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection