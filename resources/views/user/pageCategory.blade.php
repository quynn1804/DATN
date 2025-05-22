@extends('user.layouts.master')
@section('title', 'Sản phẩm')
@section('content')

    @php
        if (!function_exists('getImageUrl')) {
            function getImageUrl($path, $default = 'images/default.png')
            {
                if ($path && file_exists(public_path('storage/' . $path))) {
                    return asset('storage/' . $path);
                }
                return asset($default);
            }
        }
    @endphp
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="demo4.html">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9 main-content">
                <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                    <div class="toolbox-left">
                        <a href="#" class="sidebar-toggle">
                            <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                    class="cls-2"></path>
                                <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                    class="cls-2"></path>
                            </svg>
                            <span>Filter</span>
                        </a>

                        {{-- <div class="toolbox-item toolbox-sort">
                            <label>Sort By:</label>

                            <div class="select-custom">
                                <select name="orderby" class="form-control">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->


                        </div> --}}
                        <!-- End .toolbox-item -->
                    </div>
                    <!-- End .toolbox-left -->

                    {{-- <div class="toolbox-right">
                        <div class="toolbox-item toolbox-show">
                            <label>Show:</label>

                            <div class="select-custom">
                                <select name="count" class="form-control">
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->
                        </div>
                        <!-- End .toolbox-item -->


                        <div class="toolbox-item layout-modes">
                            <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                                <i class="icon-mode-grid"></i>
                            </a>
                            <a href="category-list.html" class="layout-btn btn-list" title="List">
                                <i class="icon-mode-list"></i>
                            </a>
                        </div>
                        <!-- End .layout-modes -->
                    </div> --}}
                    <!-- End .toolbox-right -->
                </nav>
                @php
                    if (!function_exists('getImageUrl')) {
                        function getImageUrl($path, $default = 'images/default.png')
                        {
                            if ($path && file_exists(public_path('storage/' . $path))) {
                                return asset('storage/' . $path);
                            }
                            return asset($default);
                        }
                    }

                    if (!function_exists('formatPrice')) {
                        function formatPrice($price)
                        {
                            return number_format($price, 0, ',', '.') . ' VNĐ';
                        }
                    }
                @endphp
                @if ($products->isNotEmpty())
                    <div class="row">

                        @foreach ($products as $product)
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('singleProduct', $product->id) }}">
                                            @php
                                                $mainImage = null;

                                                if (is_array($product->images) && count($product->images) > 0) {
                                                    $mainImage = $product->images[0];
                                                } elseif ($product->variants && $product->variants->count() > 0) {
                                                    $firstVariant = $product->variants->first();
                                                    if (
                                                        is_array($firstVariant->images) &&
                                                        count($firstVariant->images) > 0
                                                    ) {
                                                        $mainImage = $firstVariant->images[0];
                                                    }
                                                }
                                                $mainImageUrl = getImageUrl($mainImage);
                                            @endphp
                                            <img src="{{ $mainImageUrl }}" alt="{{ $product->name }}">
                                        </a>

                                        <div class="label-group">
                                            {{-- <div class="product-label label-hot">{{ $product['type'] }}</div> --}}

                                            @if ($product->price_sale > 0)
                                                <div class="product-label label-sale">Sale</div>
                                            @endif
                                        </div>
                                    </figure>

                                    <div class="product-details" >
                                        <div class="category-wrap" style="">
                                            <div class="category-list">
                                                <a href="#" class="product-category">
                                                    {{ $product->category->name }}
                                                </a>
                                            </div>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="{{ route('singleProduct', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>

                                        <div class="ratings-container">
                                            @php
                                                $rating = $product->rating ?? 0; // nếu null thì gán 0
                                                $ratingPercent = ($rating / 5) * 100;
                                            @endphp

                                            <div class="product-ratings">
                                                <span class="ratings" style="width: {{ $ratingPercent }}%"></span>
                                                <span class="tooltiptext tooltip-top">{{ number_format($rating, 1) }} /
                                                    5</span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <!-- End .product-container -->

                                        <div class="price-box  text-center">
                                            @if ($product->product_type === 'single')
                                                {{-- <hr> --}}
                                                <p><strong>Giá:</strong> <span
                                                        class="product-price">{{ number_format($product->price, 0, ',', '.') }}
                                                        VNĐ</span></p>
                                            @else
                                                {{-- <hr> --}}
                                                @php
                                                    $prices = $product->variants->pluck('price')->sort();
                                                    $minPrice = $prices->first();
                                                    $maxPrice = $prices->last();
                                                @endphp
                                                <p>
                                                    <span class="product-price">
                                                        @if ($minPrice !== $maxPrice)
                                                            <span class="product-price">
                                                                {{ formatPrice($minPrice) }}
                                                            </span>
                                                        @endif

                                                        <del class="old-price">{{ formatPrice($maxPrice) }}đ</del>
                                                        {{-- {{ number_format($minPrice, 0, ',', '.') }} VNĐ
                                @if ($minPrice !== $maxPrice)
                                    - {{ number_format($maxPrice, 0, ',', '.') }} VNĐ
                                @endif --}}
                                                    </span>
                                                </p>
                                            @endif
                                        </div>

                                        <!-- End .price-box -->

                                        <div class="product-action">

                                            <a href="{{ route('singleProduct', $product->id) }}"
                                                class="btn-icon btn-add-cart">
                                                <i class="fa fa-arrow-right"></i>
                                                <span>Chi tiết sản phẩm</span>
                                            </a>

                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End .row -->

                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show">
                            <label></label>

                            <div class="select">

                                <label></label>

                                </select>
                            </div>
                            <!-- End .select-custom -->
                        </div>
                        <!-- End .toolbox-item -->

                        <ul class="pagination toolbox-item">

                            {{ $products->links('pagination::bootstrap-5') }}

                        </ul>
                    </nav>
                @else
                    <div class="align-content-center min-vh-100">
                        <h4 class="text-danger text-center align-content-center">Không có sản phẩn nào</h4>
                    </div>
                @endif
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>

            {{-- Category --}}
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                aria-controls="widget-body-2">Danh Mục</a>
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($categories->take(10) as $category)
                                        <li>
                                            <a href="{{ route('products.filter', ['category_id' => $category->id]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
                                aria-controls="widget-body-3">Dung Lượng</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($Capacities->take(10) as $Capacity)
                                        <li>
                                            <a
                                                href="{{ route('products.filter', ['capacity_id' => $Capacity->id]) }}">{{ $Capacity->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"
                                aria-controls="widget-body-4">Màu Sắc</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($colors->take(5) as $color)
                                        <li>
                                            <a
                                                href="{{ route('products.filter', ['color_id' => $color->id]) }}">{{ $color->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>


                    {{-- <div class="widget widget-color">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Color</a>
                </h3>

                <div class="collapse show" id="widget-body-4">
                    <div class="widget-body pb-0">
                        <ul class="config-swatch-list">
                            <li class="active">
                                <a href="#" style="background-color: #000;"></a>
                            </li>
                            <li>
                                <a href="#" style="background-color: #0188cc;"></a>
                            </li>
                            <li>
                                <a href="#" style="background-color: #81d742;"></a>
                            </li>
                            <li>
                                <a href="#" style="background-color: #6085a5;"></a>
                            </li>
                            <li>
                                <a href="#" style="background-color: #ab6e6e;"></a>
                            </li>
                        </ul>
                    </div>
                    <!-- End .widget-body -->
                </div>
                <!-- End .collapse -->
            </div> --}}
                    <!-- End .widget -->
                    <!-- End .widget -->
                </div>
                <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->

    <div class="mb-4"></div>
    <!-- margin -->
    <style>
        .product-default {
            display: flex;
            flex-direction: column;
            height: 100%;
            /* đảm bảo khối sản phẩm chiếm toàn bộ chiều cao */
        }

        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-action {
            margin-top: auto;
        }
    </style>
@endsection
