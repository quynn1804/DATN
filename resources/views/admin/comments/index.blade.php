@extends('admin.layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="overflow-hidden card table-nowrap table-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách bình luận</h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Người bình luận</th>
                                <th>Đánh giá</th>
                                <th>Nội dung</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr class="align-middle">
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->product->name }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->rating }} ★</td>
                                    <td>{{ $comment->content }}</td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <a data-bs-toggle="dropdown" href="#" class="btn p-1">
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.comments.show', $comment->id) }}" class="dropdown-item">Xem</a>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body{margin-top:20px;
background:#eee;
}
.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.avatar.sm {
    width: 2.25rem;
    height: 2.25rem;
    font-size: .818125rem;
}
.table-nowrap .table td, .table-nowrap .table th {
    white-space: nowrap;
}
.table>:not(caption)>*>* {
    padding: 0.75rem 1.25rem;
    border-bottom-width: 1px;
}
table th {
    font-weight: 600;
    background-color: #eeecfd !important;
}
</style>
@endsection