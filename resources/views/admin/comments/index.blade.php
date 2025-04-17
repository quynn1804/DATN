@extends('admin.layouts.master')
@section('title', 'Danh sách bình luận')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Danh sách bình luận</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Danh mục</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive min-vh-100">
                    @if ($comments->isNotEmpty())
                    <div class="min-vh-100">
                        <table class="table align-middle table-nowrap text-center dt-responsive nowrap w-100">
                            <thead class="">
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Người bình luận</th>
                                    <th>Đánh giá</th>
                                    <th>Nội dung</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>{{ $comment->product->name }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->rating }} ★</td>
                                    <td>{{ $comment->content }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @else
                    <div class="min-vh-100 text-center align-content-center">
                        <h1 class="text-danger">Không có data !!!</h1>
                    </div>
                    @endif
                </div>

                @if ($comments->isNotEmpty())
                <div class="row">
                    {{ $comments->links('admin.layouts.components.pagination') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
