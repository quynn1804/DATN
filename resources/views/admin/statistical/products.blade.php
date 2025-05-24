@extends('admin.layouts.master')
@section('title', 'Thống kê sản phẩm')
@section('content')

    {{-- <div class="row">
        <div class="d-flex gap-2 mb-4">

            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-muted border-0">
                    <i class="bi bi-geo-alt-fill"></i>
                </span>

                <input type="date" name="date" id="date" class="form-control border-0 shadow-sm">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ngày</label>
                <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ngày</label>
                <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ngày</label>
                <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" />
            </div>

        </div>
    </div> --}}


    <div class="row">
        <form method="GET">

            <div class="row">
                <div class="col-md-2">
                    <label class="mb-0">Ngày bắt đầu</label>
                </div>
                <div class="col-md-2">
                    <label class="mb-0">Ngày kết thúc</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate ?: '' }}">
                </div>

                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate ?: '' }}">
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
            <div class="card blog-stats-wid">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-muted mb-2">
                                {{ $titleTotalPrice }}
                            </p>
                            <h5 class="mb-0">
                                {{ number_format($totalPriceOrder, 0, ',', '.') }}đ
                            </h5>
                        </div>

                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mini-stats-wid">
                <div class="card-body">

                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-muted mb-2">Tổng số sản phẩm</p>
                            <h5 class="mb-0">
                                {{ $countProduct }}
                            </h5>
                        </div>

                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                <i class="fa-solid fa-shirt"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card blog-stats-wid">
                <div class="card-body">

                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-muted mb-2">Đơn hàng chưa xử lý</p>
                            <h5 class="mb-0">
                                {{ $countOrderPending }}
                            </h5>
                        </div>

                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card blog-stats-wid">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-3">
                            <p class="text-muted mb-2">Đơn hàng giao thành công</p>
                            <h5 class="mb-0">
                                {{ $countOrderCompleted }}
                            </h5>
                        </div>

                        <div class="avatar-sm ms-auto">
                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                <i class="fa-solid fa-clipboard-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
    <div class="row">
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Orders</p>
                            <h4 class="mb-0">1,235</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-copy-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Revenue</p>
                            <h4 class="mb-0">$35, 723</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center ">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-archive-in font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Average Price</p>
                            <h4 class="mb-0">$16.2</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Average Price</p>
                            <h4 class="mb-0">$16.2</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Doanh thu hôm nay</p>
                            <h4 class="mb-0">333.333.330.000.000đ</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <p class="mb-0">
                        <span class="badge badge-soft-success me-1">
                            <i class="bx bx-trending-up align-bottom me-1"></i>
                            10%
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
                            <p class="text-muted fw-medium">Đơn hàng chờ xử lý</p>
                            <h4 class="mb-0">2</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <p class="mb-0">
                        <span class="badge badge-soft-success me-1">
                            <i class="bx bx-trending-up align-bottom me-1"></i>
                            30%
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
                            <p class="text-muted fw-medium">Đơn hàng giao thành công</p>
                            <h4 class="mb-0">20.000</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <p class="mb-0">
                        <span class="badge badge-soft-success me-1">
                            <i class="bx bx-trending-up align-bottom me-1"></i>
                            8.41%
                        </span>
                        Increase
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
                            <p class="text-muted fw-medium">Total Rejected</p>
                            <h4 class="mb-0">12,487</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <p class="mb-0"> <span class="badge badge-soft-danger me-1"><i
                                class="bx bx-trending-down align-bottom me-1"></i> 20.63%</span>
                        Decrease last month</p>
                </div>
            </div>
        </div>
        <!--end col-->
    </div> --}}
    <!--end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card card-h-100">
                <div class="card-body">
                    <div id="productChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center mb-4" style="color: #2C3E50;">
                Top 3 Sản Phẩm Doanh Thu Cao Nhất
            </h3>
            <div class="row justify-content-center">
                @if ($topProductSale->isNotEmpty())
                    @foreach ($topProductSale as $index => $item)
                        <div class="col-md-4 col-lg-4 mb-4">
                            <div class="card top6-card shadow-sm h-100">
                                <div class="position-relative">
                                    @php
                                        $images = is_array($item->productVariant->images)
                                            ? $item->productVariant->images
                                            : [];

                                        // Kiểm tra xem mảng có phần tử 0 không
                                        if (!empty($images) && array_key_exists(0, $images)) {
                                            $firstImage = $images[0];
                                        } else {
                                            @dd($images);
                                        }
                                    @endphp

                                    <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top"
                                        style="height: 300px; object-fit: cover;"
                                        alt="{{ $item->productVariant->product->name }}">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">
                                        {{ $item->productVariant->product->name }}
                                    </h5>
                                    <p class="mb-2">
                                        <strong>Doanh thu:</strong>
                                        <span style="color: #483D8B;">
                                            {{ number_format($item->total_revenue, 0, ',', '.') }} đ
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mb-3">
                        <div class="card top6-card shadow-sm h-100">
                            <div class="card-body text-center">
                                <h1 class="text-danger text-center">
                                    Không có dữ liệu
                                </h1>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center mb-4" style="color: #2C3E50;">
                Sản phẩm sắp hết hàng (tồn kho ít hơn 10 sản phẩm)
            </h3>
            <div class="row justify-content-center">
                @if ($lowStockProducts->isNotEmpty())
                    @foreach ($lowStockProducts as $product)
                        @php
                            $variant = $product->variants->first();
                            $image =
                                $variant && $variant->images && count($variant->images) > 0
                                    ? asset('storage/' . $variant->images[0])
                                    : 'https://via.placeholder.com/240x240?text=No+Image';
                        @endphp

                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ $image }}" class="card-img-top"
                                    style="height: 240px; object-fit: cover;" alt="{{ $product->name }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mb-3">
                        <div class="card top6-card shadow-sm h-100">
                            <div class="card-body text-center">
                                <h1 class="text-danger text-center">
                                    Không có dữ liệu
                                </h1>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center mb-4" style="color: #2C3E50;">
                Top 3 Sản Phẩm Không Bán Chạy Nhất
            </h3>
            <div class="row justify-content-center">
                @if ($lowSaleProducts->isNotEmpty())
                    @foreach ($lowSaleProducts as $item)
                        <div class="col-md-4 col-lg-4 mb-4">
                            <div class="card top6-card shadow-sm h-100">
                                <div class="position-relative">

                                    @php
                                        $images = is_array($item->images)
                                            ? $item->images
                                            : json_decode($item->images, true) ?? [];
                                        $firstImage = count($images) > 0 ? $images[0] : null;
                                    @endphp

                                    @if ($firstImage)
                                        <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top"
                                            alt="" style="height: 240px;">
                                    @endif
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">
                                        {{ $item->product->name }}
                                    </h5>
                                    <p class="mb-2">
                                        <strong>Số lượng đã bán:</strong>
                                        <span style="color: #483D8B;">
                                            {{ $item->total_sold }}
                                        </span>
                                    </p>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <a href="{{ route('admin.products.show', ['product' => $item->product->id]) }}"
                                        class="btn btn-primary">
                                        Xem chi tiết
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
            </div>
        @else
            <div class="mb-3">
                <div class="card top6-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h1 class="text-danger text-center">
                            Không có dữ liệu
                        </h1>
                    </div>
                </div>
            </div>
            @endif
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
            window.location.href = `${APP_URL}/admin/statistical/products`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            let foodNames = @json($foodNames);
            let foodRevenues = @json($foodRevenues);
            let foodSummaries = @json($foodSummaries);

            console.log(foodNames);
            console.log(foodRevenues);
            console.log(foodSummaries);

            if (foodNames.length > 0 && foodRevenues.length > 0) {
                Highcharts.chart('productChart', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Doanh thu theo sản phẩm'
                    },
                    xAxis: {
                        categories: foodNames, // Sử dụng tên đồ ăn làm danh mục trục X
                        crosshair: true,
                        accessibility: {
                            description: 'Tên Đồ Ăn'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Doanh thu (VNĐ)' // Tiêu đề trục Y
                        }
                    },
                    tooltip: {
                        pointFormatter: function() {
                            var index = this.index; // Lấy chỉ số của điểm dữ liệu
                            return `${foodSummaries[index]}`; // Chỉ hiển thị tóm tắt, không lặp tên đồ ăn
                        }
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                            color: '#191970' // Giữ màu nền từ Chart.js
                        }
                    },
                    series: [{
                        name: 'Doanh thu (VNĐ)',
                        data: foodRevenues // Dữ liệu doanh thu từ PHP
                    }],
                    credits: {
                        enabled: false // Tắt dòng chữ "Highcharts.com"
                    }
                });
            } else {
                document.querySelector('#productChart').innerHTML =
                    `<p style="font: 20px Arial; text-align: center; margin-top: 200px;">Không có dữ liệu để hiển thị</p>`
            }


        })
    </script>

@endsection
