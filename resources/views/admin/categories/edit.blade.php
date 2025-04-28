@extends('admin.layouts.master')
@section('title', 'New Category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Thêm danh mục</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Danh mục</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>


        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">
                                    <span class="text-danger">*</span>
                                    Tên
                                </label>
                                <input id="projectname-input" name="name" type="text" class="form-control" placeholder="Nhập tên danh mục..." value="{{ $category->name }}" required>
                                @error('name')
                                <div class="text-danger fst-italic">
                                    * {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">
                                    <span class="text-danger">*</span>
                                    Trạng thái
                                </label>
                                <select class="form-select" name="is_active">
                                    <option value="1" {{ $category->is_active ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="0" {{ !$category->is_active ? 'selected' : '' }}>Ẩn</option>
                                </select>
                                @error('is_active')
                                <div class="text-danger fst-italic">
                                    * {{ $message }}
                                </div>
                                @enderror
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
