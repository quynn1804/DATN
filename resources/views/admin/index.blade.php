@extends('admin.layouts.master')
@section('title', 'Trang Chủ')
@section('content')
    <div class="row">
        <form method="GET">

            <div class="row">
                <div class="col-md-2">
                    <label class="mb-0">Ngày</label>
                </div>
                <div class="col-md-2">
                    <label class="mb-0">Tháng</label>
                </div>
                <div class="col-md-2">
                    <label class="mb-0">Năm</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <input type="date" name="date" class="form-control" value="{{ $selectedDay ?: '' }}">
                </div>

                <div class="col-md-2">
                    <select name="month" class="form-select">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>
                                Tháng {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="year" class="form-select">

                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                Năm {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit"
                            class="btn btn-sm btn-success rounded-circle p-2 d-flex align-items-center justify-content-center"
                            title="Lọc dữ liệu" style="width: 36px; height: 36px;">
                            <i class="fa-solid fa-filter"></i>
                        </button>

                        <button type="button"
                            class="btn btn-sm btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center"
                            title="Reset bộ lọc" style="width: 36px; height: 36px;" onclick="resetFilter()">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">
                                {{ $selectedDay ? "Doanh thu ngày " . date('d/m', strtotime($selectedDay)) : 'Doanh thu hôm nay' }}
                            </p>
                            <h4 class="mb-0">
                                {{ number_format($dailyRevenue, 0, ',', '.') }}đ
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    @php
                        $changePercentage = 0;

                        if ($previousRevenue == 0) {
                            $changePercentage = $dailyRevenue > 0 ? 100 : 0;
                        } else {
                            $changePercentage = (($dailyRevenue - $previousRevenue) / $previousRevenue) * 100;
                        }

                        $changeClass = 'badge-soft-secondary';
                        $changeIcon = 'bx bx-minus';

                        if ($changePercentage > 0) {
                            $changeClass = 'badge-soft-success';
                            $changeIcon = 'bx bx-trending-up';
                        } elseif ($changePercentage < 0) {
                            $changeClass = 'badge-soft-danger';
                            $changeIcon = 'bx bx-trending-down';
                        }

                        $changePercentageFormatted = number_format(abs($changePercentage), 0);
                    @endphp

                    <p class="mb-0">
                        <span class="badge {{ $changeClass }} me-1">
                            <i class="{{ $changeIcon }} align-bottom me-1"></i>
                            {{ $changePercentageFormatted }}%
                        </span>
                        So với hôm qua
                    </p>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">
                                Doanh thu tháng {{ $selectedMonth ?: date('n')  }}
                            </p>
                            <h4 class="mb-0">
                                {{ number_format($monthlyRevenue, 0, ',', '.') }}đ
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    @php
                        $changePercentageMonth = 0;

                        if ($previousRevenueMonth == 0) {
                            $changePercentageMonth = $monthlyRevenue > 0 ? 100 : 0;
                        } else {
                            $changePercentageMonth = (($monthlyRevenue - $previousRevenueMonth) / $previousRevenueMonth) * 100;
                        }

                        $changeClassMonth = 'badge-soft-secondary';
                        $changeIconMonth = 'bx bx-minus';

                        if ($changePercentageMonth > 0) {
                            $changeClassMonth = 'badge-soft-success';
                            $changeIconMonth = 'bx bx-trending-up';
                        } elseif ($changePercentageMonth < 0) {
                            $changeClassMonth = 'badge-soft-danger';
                            $changeIconMonth = 'bx bx-trending-down';
                        }

                        $changePercentageFormattedMonth = number_format(abs($changePercentageMonth), 0);
                    @endphp

                    <p class="mb-0">
                        <span class="badge {{ $changeClassMonth }} me-1">
                            <i class="{{ $changeIconMonth }} align-bottom me-1"></i>
                            {{ $changePercentageFormattedMonth }}%
                        </span>
                        So với tháng trước
                    </p>

                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Khách hàng</p>
                            <h4 class="mb-0">
                                {{ $countUser }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <p class="mb-0">
                        <span class="badge badge-soft-success me-1">
                            <i class="bx bx-trending-up align-bottom me-1"></i>
                            8.41%
                        </span>
                        Tháng trước
                    </p>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">
                                Đơn hàng tháng {{ $selectedMonth }}
                            </p>
                            <h4 class="mb-0">
                                {{ $orderCountByMonth }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    @php
                        $changePercentageOrderCount = 0;

                        if ($orderCountPreviousMonth == 0) {
                            $changePercentageOrderCount = $orderCountByMonth > 0 ? 100 : 0;
                        } else {
                            $changePercentageOrderCount = (($orderCountByMonth - $orderCountPreviousMonth) / $orderCountPreviousMonth) * 100;
                        }

                        $changeOrderClass = 'badge-soft-secondary';
                        $changeOrderIcon = 'bx bx-minus';
                        $changeText = 'So với tháng trước';

                        if ($changePercentageOrderCount > 0) {
                            $changeOrderClass = 'badge-soft-success';
                            $changeOrderIcon = 'bx bx-trending-up';
                            $changeText = 'So với tháng trước';
                        } elseif ($changePercentageOrderCount < 0) {
                            $changeOrderClass = 'badge-soft-danger';
                            $changeOrderIcon = 'bx bx-trending-down';
                            $changeText = 'So với tháng trước';
                        }

                        $changePercentageOrderFormatted = number_format(abs($changePercentageOrderCount), 0);
                    @endphp

                    <p class="mb-0">
                        <span class="badge {{ $changeOrderClass }} me-1">
                            <i class="{{ $changeOrderIcon }} align-bottom me-1"></i>
                            {{ $changePercentageOrderFormatted }}%
                        </span>
                        {{ $changeText }}
                    </p>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div id="orderStatusChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div id="orderStatusPaymentChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-h-100">
                <div class="card-body">
                    <div id="totalPriceOrder" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!--end row-->
@endsection

@section('script')
    <!-- dashboard blog init -->
    <script src="{{ asset('theme/admin/js/pages/dashboard-job.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>

        const APP_URL = "{{ env('APP_URL') }}"

        const resetFilter = () => {
            window.location.href = `${APP_URL}/admin`
        }

        document.addEventListener("DOMContentLoaded", function () {
            const revenues = @json($monthlyRevenues);
            const orderCounts = @json($monthlyOrderCounts);

            if (revenues.length > 0) {
                Highcharts.chart('totalPriceOrder', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Doanh thu theo năm'
                    },
                    xAxis: {
                        categories: [
                            "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
                            "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                        ],
                        crosshair: true,
                        title: {
                            text: 'Tháng'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Doanh thu (VNĐ)'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat:
                            '<tr><td style="color:{series.color};padding:0">Doanh thu: </td>' +
                            '<td style="padding:0"><b>{point.y:,.0f} VND</b></td></tr>' +
                            '<tr><td style="padding:0">Số đơn hàng:</td><td><b>{point.orderCount}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            minPointLength: 3,
                            pointPadding: 0.2,
                            borderWidth: 0,
                            color: '#191970'
                        }
                    },
                    series: [{
                        name: 'Doanh thu (VNĐ)',
                        data: revenues.map((rev, i) => ({
                            y: rev,
                            orderCount: orderCounts[i] || 0
                        }))
                    }],
                    credits: {
                        enabled: false
                    }
                });
            } else {
                document.getElementById('totalPriceOrder').innerHTML =
                    '<p style="font: 20px Arial; text-align: center; margin-top: 200px;">Không có dữ liệu để hiển thị</p>';
            }

            /*
                Biểu đồ trạng thái đơn hàng
            */
            Highcharts.setOptions({
                colors: Highcharts.getOptions().colors.map(function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')]
                        ]
                    };
                })
            });

            const orderStatusData = @json($orderStatusData);

            Highcharts.chart('orderStatusChart', {
                chart: {
                    type: 'pie',
                    plotShadow: false
                },
                title: {
                    text: 'Tỷ lệ trạng thái đơn hàng'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<span style="font-size: 1.1em"><b>{point.name}</b></span><br>' +
                                '<span style="opacity: 0.7">{point.percentage:.1f}%</span>',
                            connectorColor: 'rgba(128,128,128,0.5)'
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Tỷ lệ',
                    colorByPoint: true,
                    data: orderStatusData
                }]
            });

            /*
                Tỉ lệ phương thức thanh toán
            */
            Highcharts.chart('orderStatusPaymentChart', {
                chart: {
                    type: 'pie',
                    plotShadow: false
                },
                title: {
                    text: 'Tỷ lệ phương thức thanh toán'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<span style="font-size: 1.1em"><b>{point.name}</b></span><br>' +
                                '<span style="opacity: 0.7">{point.percentage:.1f}%</span>',
                            connectorColor: 'rgba(128,128,128,0.5)'
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Tỷ lệ',
                    colorByPoint: true,
                    data: @json($orderStatusPayment)
                }]
            });


        });


    </script>
@endsection
