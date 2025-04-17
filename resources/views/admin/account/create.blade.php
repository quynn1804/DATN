@extends('admin.layouts.master')
@section('title', 'New User')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Thêm mới người dùng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.account.index') }}">Người dùng</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>


        <form id="form-user-create" action="{{ route('admin.account.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>

                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                        <i class='bx bxs-image-alt'></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" value="" id="project-image-input" type="file" accept="image/png, image/gif, image/jpeg" name="image" onchange="previewImage(event)">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img src id="projectlogo-img" class="avatar-lg h-auto rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tên</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên của bạn..." value="{{ old('name') }}">
                                        @error('name')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Mật khẩu</label>
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu..." value="{{ old('password') }}">
                                        @error('password')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email..." value="{{ old('email') }}">
                                        @error('email')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nhập lại mật khẩu</label>
                                        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Xác nhận mật khẩu..." value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại..." value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Giới tính</label>
                                        <select name="gender" class="form-select" required>
                                            <option value="Nam">Nam</option>
                                            <option value="Nu">Nữ</option>
                                            <option value="Khac">Khác</option>
                                        </select>
                                        @error('gender')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title mb-3">Publish</h5> --}}

                            <div class="mb-3">
                                <label class="form-label">Vai trò</label>
                                <select class="form-select" name="role_id">
                                    <option value="2">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" required>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hoạt động
                                    </option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tạm dừng
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('script')

<script src="{{ asset('theme/admin/libs/dropzone/dropzone-min.js') }}"></script>
<script>
    const previewImage = (event) => {
        const img = document.getElementById('projectlogo-img');
        img.src = URL.createObjectURL(event.target.files[0]);
    }

</script>
@endsection
