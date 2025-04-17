@extends('admin.layouts.master')
@section('title', 'Mã giảm giá')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Danh sách đơn hàng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Quản lý đơn hàng</li>
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
                    <div class="col-sm-12">
                        <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3 px-3 ms-auto">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập mã đơn hàng hoặc tên khách hàng..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="month" class="form-select">
                                        <option value="">Chọn tháng</option>
                                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                            Tháng {{ $i }}
                                            </option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="year" class="form-select">
                                        <option value="">Chọn năm</option>
                                        @php $currentYear = date('Y'); @endphp
                                        @for ($i = $currentYear; $i >= $currentYear - 5; $i--)
                                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive min-vh-100">
                    @if ($orders->isNotEmpty())

                    @php
                    $statusMapping = [
                    'pending' => 'Đang chờ xử lý',
                    'processing' => 'Đang xử lý',
                    'shipping' => 'Đang giao hàng',
                    'completed' => 'Hoàn thành',
                    'cancelled' => 'Đã hủy',
                    ];

                    $statusColor = [
                    'pending' => 'bg-warning',
                    'processing' => 'bg-primary',
                    'shipping' => 'bg-info',
                    'completed' => 'bg-success',
                    'cancelled' => 'bg-danger',
                    ];
                    @endphp

                    <div class="min-vh-100">
                        <table class="table align-middle table-nowrap text-center dt-responsive nowrap w-100">
                            <thead class="">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày Tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge p-2 {{ $statusColor[$order->status] ?? 'badge-secondary' }}">
                                            {{ $statusMapping[$order->status] ?? 'Không xác định' }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-warning btn-sm">
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

                @if ($orders->isNotEmpty())
                <div class="row">
                    {{ $orders->links('admin.layouts.components.pagination') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
