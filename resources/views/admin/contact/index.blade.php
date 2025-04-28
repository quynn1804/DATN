@extends('admin.layouts.master')
@section('title', 'Contect')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Danh sách liên hệ</h4>

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

                    @if($contacts->isNotEmpty())
                    <div class="min-vh-100">
                        <table class="table align-middle text-center table-nowrap dt-responsive nowrap w-100">
                            <thead class="">
                                <tr>
                                    <th>STT</th>
                                    <th>Người gửi</th>
                                    <th>Email</th>
                                    <th>Chủ đề</th>
                                    <th>Tin nhắn</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày gửi</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ Str::limit($contact->message, 15) }}</td>

                                    <td>
                                        @if ($contact->status === 'đã trả lời')
                                        <span class="badge bg-success">Đã trả lời</span>
                                        @else
                                        <span class="badge bg-warning">Chưa trả lời</span>
                                        @endif
                                    </td>

                                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>

                                    <td>
                                        <a href="{{ route('admin.contacts.edit', $contact) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                    </td>
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

                @if ($contacts->isNotEmpty())
                <div class="row">
                    {{ $contacts->links('admin.layouts.components.pagination') }}
                </div>
                @endif
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
@endsection
