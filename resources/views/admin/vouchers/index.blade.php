@extends('admin.layouts.master')
@section('title', 'Mã giảm giá')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Danh sách voucher</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Quản lý voucher</li>
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
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <form method="GET" action="{{ route('admin.vouchers.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="searchTableList" placeholder="Tìm theo mã hoặc loại..." name="search" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-select">
                                        <option value="">-- Lọc trạng thái --</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tắt</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-sm-end">
                            <a href="{{ route('admin.vouchers.create') }}" class="btn btn-success waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                <i class="mdi mdi-plus me-1"></i>
                                Thêm
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive min-vh-100">
                    @if ($vouchers->isNotEmpty())
                    <div class="min-vh-100">
                        <table class="table align-middle table-nowrap text-center dt-responsive nowrap w-100">
                            <thead class="">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã Voucher</th>
                                    <th>Loại</th>
                                    <th>Giá trị giảm</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Lượt dùng / Giới hạn</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($vouchers as $voucher)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td><strong>{{ $voucher->code }}</strong></td>

                                    <td>{{ $voucher->discount_type === 'fixed' ? 'Tiền mặt' : 'Phần trăm' }}</td>

                                    <td>
                                        @if ($voucher->discount_type === 'fixed')
                                        {{ number_format($voucher->discount_value) }} VNĐ
                                        @else
                                        {{ $voucher->discount_value }}%
                                        @if ($voucher->max_discount_amount)
                                        (Tối đa: {{ number_format($voucher->max_discount_amount) }} VNĐ)
                                        @endif
                                        @endif
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($voucher->start)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($voucher->end)->format('d/m/Y') }}</td>
                                    <td>{{ $voucher->used_count ?? 0 }} / {{ $voucher->usage_limit ?? '∞' }}</td>

                                    <td>
                                        <span class="badge font-size-12 p-2 {{ $voucher->is_active ? 'bg-success' : ' bg-danger' }}">
                                            {{ $voucher->is_active ? 'Kích hoạt' : 'Tắt' }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit">
                                            </i>

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

                @if ($vouchers->isNotEmpty())
                <div class="row">
                    {{ $vouchers->links('admin.layouts.components.pagination') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
