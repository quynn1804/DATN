@extends('admin.layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="overflow-hidden card table-nowrap table-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách tài khoản</h5>
                    <a href="{{ route('admin.account.create') }}" class="btn btn-primary btn-sm ms-auto">Thêm tài khoản</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="align-middle">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->role_id }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        <img src="{{ asset('assets/images/' . $item->image) }}" width="50" class="avatar sm rounded-pill">
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $item->status ? 'Hoạt động' : 'Bị khóa' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <a data-bs-toggle="dropdown" href="#" class="btn p-1">
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.account.edit', $item->id) }}" class="dropdown-item">Sửa</a>
                                                <form action="{{ route('admin.account.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
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
