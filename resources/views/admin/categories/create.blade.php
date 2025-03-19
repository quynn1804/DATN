@extends('admin.layouts.index')

@section('content')
<div class="bg-white rounded-lg shadow-md" style="margin-left: 50px;margin-right: 50px; border-radius: 2px">
    <div class="card-header mb-4" style="background:#ebe8ff;border-radius: 2px; height: 55px;">
        <h4 class="text-center" style="font-weight: 400; ">Thêm danh mục</h4>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="row justify-content-between text-left" style="margin-left: 100px">
            <div class="col-10">
                <div class="form-group">
                    <label for="name">Tên danh mục <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label>Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-control" name="is_active">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div style="margin: 50px 0">
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
