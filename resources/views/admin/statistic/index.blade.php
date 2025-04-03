@extends('admin.layouts.index')

@section('title', 'Thống kê đơn hàng')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Thống kê đơn hàng</h1>

        <!-- Form lọc theo ngày -->
        <form method="GET" action="{{ route('admin.statistic.index') }}" class="mb-3">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label>Từ ngày:</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="form-control">
                </div>
                <div class="col-auto">
                    <label>Đến ngày:</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mt-4">Lọc</button>
                </div>
            </div>
        </form>

        <!-- Thống kê Doanh thu -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-dark text-white p-3">
                    <h4>Doanh Thu Hôm Nay</h4>
                    <p>{{ number_format($todayRevenue, 0, ',', '.') }} VND</p>
                    <p>Tháng này: {{ number_format($monthlyRevenue, 0, ',', '.') }} VND (+{{ $growth }}%)</p>
                    <p>Tháng trước: {{ number_format($lastMonthRevenue, 0, ',', '.') }} VND</p>
                </div>
            </div>

            <!-- Thống kê tổng đơn hàng -->
            <div class="col-md-6">
                <div class="card bg-dark text-white p-3">
                    <h4>Thông Kê Đơn Hàng</h4>
                    <!-- Biểu đồ cột tổng đơn hàng -->
                    <canvas id="totalOrdersChart"></canvas>
                </div>
            </div>
            <div class="col-md-3">
                <h3 class="mt-4">Top 5 sản phẩm bán chạy</h3>
                <canvas id="topProductsChart"></canvas>

                <!-- Bảng danh sách sản phẩm bán chạy -->
                <table class="table table-bordered mt-3 bg-light text-dark">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng đã bán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->total_sold }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Biểu đồ top 5 sản phẩm bán chạy -->


    </div>

    <!-- Thêm thư viện Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Biểu đồ tổng đơn hàng theo ngày (cột)
            var ctxTotalOrders = document.getElementById('totalOrdersChart').getContext('2d');
            new Chart(ctxTotalOrders, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($orderStats->keys()->toArray()) !!}, // Ngày
                    datasets: [{
                        label: 'Tổng đơn hàng',
                        data: {!! json_encode($orderStats->values()->toArray()) !!}, // Số đơn hàng
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        barPercentage: 0.5, // Giảm kích thước cột
                        categoryPercentage: 0.7 // Khoảng cách giữa các nhóm cột
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Biểu đồ top 5 sản phẩm bán chạy (cột)
            var ctxTopProducts = document.getElementById('topProductsChart').getContext('2d');
            new Chart(ctxTopProducts, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topProducts->pluck('name')->toArray()) !!}, // Tên sản phẩm
                    datasets: [{
                        label: 'Số lượng đã bán',
                        data: {!! json_encode($topProducts->pluck('total_sold')->toArray()) !!}, // Số lượng bán
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        barPercentage: 0.5, // Giảm kích thước cột
                        categoryPercentage: 0.7 // Khoảng cách giữa các nhóm cột
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

@endsection
