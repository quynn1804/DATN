@extends('admin.layouts.master')
@section('title', 'New Category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Cập nhật trạng thái liên hệ</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.contacts.index') }}">Danh mục</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Chỉnh sửa
                    </li>
                </ol>
            </div>
        </div>


        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Họ tên
                                        </label>
                                        <input type="text" class="form-control" value="{{ $contact->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Email hoặc số điện thoại
                                        </label>
                                        <input type="text" class="form-control" value="{{ $contact->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Chủ đề
                                        </label>
                                        <input type="text" class="form-control" value="{{ $contact->subject }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Trạng thái
                                        </label>
                                        <select name="status" class="form-select">
                                            <option value="chưa trả lời" {{ $contact->status == 'chưa trả lời' ? 'selected' : '' }}>
                                                Chưa trả lời</option>
                                            <option value="đã trả lời" {{ $contact->status == 'đã trả lời' ? 'selected' : '' }}>Đã
                                                trả lời</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Tin Nhắn:
                                        </label>
                                        <textarea class="form-control" rows="5" disabled>{{ $contact->message }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
