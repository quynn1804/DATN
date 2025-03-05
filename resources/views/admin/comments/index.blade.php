@extends('admin.layouts.index')

@section('content')
<h2>Danh sách bình luận</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Người bình luận</th>
            <th>Đánh giá</th>
            <th>Nội dung</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
        <tr>
            <td>{{ $comment->id }}</td>
            <td>{{ $comment->product->name }}</td>
            <td>{{ $comment->user->name }}</td>
            <td>{{ $comment->rating }} ★</td>
            <td>{{ $comment->content }}</td>
            <td>
                <a href="{{ route('admin.comments.show', $comment->id) }}">Xem</a>
                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $comments->links() }}
@endsection
