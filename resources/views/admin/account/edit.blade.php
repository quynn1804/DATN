@extends('admin.layouts.master')
@section('title', 'New User')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Chỉnh sửa tài khoản</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.account.index') }}">Người dùng</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $account->name }}</li>
                </ol>
            </div>
        </div>


        <form id="form-user-create" action="{{ route('admin.account.update', $account) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                                <img src='{{ $account->image }}' id="projectlogo-img" class="avatar-lg h-auto rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tên</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên của bạn..." value="{{ old('name', $account->name) }}">
                                        @error('name')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mật khẩu (để trống nếu không muốn thay đổi)</label>
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu..." value="{{ old('password') }}">
                                        @error('password')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email..." value="{{ old('email', $account->email) }}">
                                        @error('email')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại..." value="{{ old('phone', $account->phone) }}">
                                        @error('phone')
                                        <div class="text-danger fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Giới tính</label>
                                        <select name="gender" class="form-select" required>
                                            <option value="Nam" {{ old('gender', $account->gender) == 'Nam' ? 'selected' : '' }}>Nam
                                            </option>
                                            <option value="Nữ" {{ old('gender', $account->gender) == 'Nữ' ? 'selected' : '' }}>Nữ
                                            </option>
                                            <option value="Khác" {{ old('gender', $account->gender) == 'Khác' ? 'selected' : '' }}>
                                                Khác</option>
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
                                    <option value="1" {{ old('role_id', $account->role_id) == 1 ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="2" {{ old('role_id', $account->role_id) == 2 ? 'selected' : '' }}>User
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" required>
                                    <option value="1" {{ old('status', $account->status) == 1 ? 'selected' : '' }}>Hoạt
                                        động</option>
                                    <option value="0" {{ old('status', $account->status) == 0 ? 'selected' : '' }}>Tạm dừng
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
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
