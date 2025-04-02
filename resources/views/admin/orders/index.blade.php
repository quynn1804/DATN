@extends('admin.layouts.index')

@section('content')
@if(session('error'))
    <div id="alert-error" class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div id="alert-success" class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
    </div>
@endif

<script>
    // Chờ 4 giây rồi ẩn thông báo
    setTimeout(function() {
        document.getElementById('alert-error')?.classList.add('d-none');
        document.getElementById('alert-success')?.classList.add('d-none');
    }, 4000);
</script>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mb-lg-5">
                <div class="overflow-hidden card table-nowrap table-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Danh sách đơn hàng</h5>
                        <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3 px-3 ms-auto">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Nhập mã đơn hàng hoặc tên khách hàng..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="month" class="form-control">
                                        <option value="">Chọn tháng</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                                Tháng {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="year" class="form-control">
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

                    <div class="table-responsive">
                        @php
                            $statusMapping = [
                                'pending' => 'Đang chờ xử lý',
                                'processing' => 'Đang xử lý',
                                'shipping' => 'Đang giao hàng',
                                'completed' => 'Hoàn thành',
                                'cancelled' => 'Đã hủy',
                            ];

                            $statusColor = [
                                'pending' => 'badge-warning',
                                'processing' => 'badge-primary',
                                'shipping' => 'badge-info',
                                'completed' => 'badge-success',
                                'cancelled' => 'badge-danger',
                            ];
                        @endphp
                        <table class="table mb-0">
                            <thead class="small text-uppercase bg-body text-muted">
                                <tr>
                                    <th>ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày Tạo</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="align-middle">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge {{ $statusColor[$order->status] ?? 'badge-secondary' }}">
                                                {{ $statusMapping[$order->status] ?? 'Không xác định' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown">
                                                <a data-bs-toggle="dropdown" href="#" class="btn p-1">
                                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="dropdown-item">Chi tiết</a>
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
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

                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
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
