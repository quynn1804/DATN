@extends('user.layouts.main')
@section('title')
    Sản phẩm
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Trang sản phẩm</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">sản phẩm</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Content Wrapper Area -->
    <div class="kenne-content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-1">
                    <div class="kenne-sidebar-catagories_area">

                        <div class="kenne-sidebar_categories category-module">
                            <div class="kenne-categories_title">
                                <h5>Danh mục sản phẩm</h5>
                            </div>
                            <div class="sidebar-categories_menu">
                                <ul>
                                    @foreach ($categories->take(5) as $category)
                                        <li>
                                        <li><a
                                                href="{{ route('products.filter', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="kenne-sidebar_categories category-module">
                            <div class="kenne-categories_title">
                                <h5>DUNG LƯỢNG</h5>
                            </div>

                            <div class="sidebar-categories_menu">
                                <ul>
                                    @foreach ($Capacities->take(5) as $Capacity)
                                        <li>
                                        <li><a
                                                href="{{ route('products.filter', ['capacity_id' => $Capacity->id]) }}">{{ $Capacity->name }}</a>
                                        </li>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="kenne-sidebar_categories category-module">
                            <div class="kenne-categories_title">
                                <h5>MÀU SẮC</h5>
                            </div>

                            <div class="sidebar-categories_menu">
                                <ul>
                                    @foreach ($colors->take(5) as $color)
                                        <li>
                                        <li><a
                                                href="{{ route('products.filter', ['color_id' => $color->id]) }}">{{ $color->name }}</a>
                                        </li>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-1 order-lg-2">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top"
                                title="Grid View"><i class="fa fa-th"></i></a>
                            <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top"
                                title="List View"><i class="fa fa-th-list"></i></a>
                        </div>


                    </div>
                    <div class="shop-product-wrap grid gridview-3 row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product-item">
                                    <div class="single-product" style="width: 255px; height: 360px;">
                                        <div class="product-img" style="width: 213.4px; height: 213.4px;">
                                            <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                                <img class="primary-img" src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
                                                <img class="secondary-img" src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
                                            </a>

                                        </div>

                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <h3 class="product-name"><a
                                                        href="{{ route('singleProduct', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                </h3>
                                                <div class="price-box">
                                                    <span
                                                        class="new-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                                    @if ($product->old_price)
                                                        <span
                                                            class="old-price"><del>{{ number_format($product->old_price, 0, ',', '.') }}đ</del></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-product_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                                <img class="primary-img" src="{{ asset('storage/' . $product->image) }}"
                                                    width="300px" height="250px" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <div class="price-box">
                                                    <span
                                                        class="new-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                                    <span
                                                        class="old-price">{{ number_format($product->old_price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <h6 class="product-name"><a
                                                        href="{{ route('singleProduct', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                </h6>
                                                <div class="product-short_desc">
                                                    <p>Danh Mục: {{ $product->category->name }}</p>
                                                </div>
                                                <div class="product-short_desc">
                                                    <p>{{ $product->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Phân trnag --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kenne-paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if ($products->hasPages())
                                            <ul class="kenne-pagination-box primary-color">
                                                
                                                @if ($products->onFirstPage())
                                                    <li class="disabled"><span>Trước</span></li>
                                                @else
                                                    <li><a href="{{ $products->previousPageUrl() }}">Trước</a></li>
                                                @endif
                    
                                                
                                                @foreach ($products->links()->elements[0] as $page => $url)
                                                    @if ($page == $products->currentPage())
                                                        <li class="active"><a href="#">{{ $page }}</a></li>
                                                    @else
                                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                    
                                                
                                                @if ($products->hasMorePages())
                                                    <li><a class="Next" href="{{ $products->nextPageUrl() }}">Sau</a></li>
                                                @else
                                                    <li class="disabled"><span>Sau</span></li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Content Wrapper Area End Here -->




    <!-- Begin Brand Area -->
    <div class="brand-area pt-90">
        <div class="container">
            <div class="brand-nav border-top border-bottom">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kenne-element-carousel brand-slider slider-nav"
                            data-slick-options='{
                                "slidesToShow": 6,
                                "slidesToScroll": 1,
                                "infinite": false,
                                "arrows": false,
                                "dots": false,
                                "spaceBetween": 30
                                }'
                            data-slick-responsive='[
                                {"breakpoint":992, "settings": {
                                "slidesToShow": 4
                                }},
                                {"breakpoint":768, "settings": {
                                "slidesToShow": 3
                                }},
                                {"breakpoint":576, "settings": {
                                "slidesToShow": 2
                                }}
                            ]'>

                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/1.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/2.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/3.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/4.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/5.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/6.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/1.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/images/brand/2.png') }}" alt="Brand Images">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Area End Here -->




    <!-- Mirrored from htmldemo.net/kenne/kenne/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 10:13:37 GMT -->

    </html>
@endsection
