@extends('user.layouts.master')
@section('title', 'Sản phẩm')
@section('content')
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
                            <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                            <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                            <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                            <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                        </svg>
                        <span>Filter</span>
                    </a>

                    <div class="toolbox-item toolbox-sort">
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


                    </div>
                    <!-- End .toolbox-item -->
                </div>
                <!-- End .toolbox-left -->

                <div class="toolbox-right">
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
                </div>
                <!-- End .toolbox-right -->
            </nav>

            @if($products->isNotEmpty())
            <div class="row">

                @foreach($products as $product)
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="product-default">
                        <figure>
                            <a href="{{ route('singleProduct', $product->id) }}">
                                <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : 'https://laravel.com/img/logomark.min.svg' }}" alt="{{ $product->name }}" width="50px" height="50px">


                            </a>

                            <div class="label-group">
                                {{-- <div class="product-label label-hot">{{ $product['type'] }}</div> --}}

                            @if($product->price_sale > 0)
                            <div class="product-label label-sale">Sale</div>
                            @endif
                    </div>
                    </figure>

                    <div class="product-details">
                        <div class="category-wrap">
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
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">

                            <span class="product-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            @if ($product->old_price)
                            <span class="old-price"><del>{{ number_format($product->old_price, 0, ',', '.') }}đ</del></span>
                            @endif

                        </div>
                        <!-- End .price-box -->

                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist">
                                <i class="icon-heart"></i>
                            </a>
                            <a href="{{ route('singleProduct', $product->id) }}" class="btn-icon btn-add-cart">
                                <i class="fa fa-arrow-right"></i>
                                <span>SELECT OPTIONS</span>
                            </a>
                            <a class="btn-quickview" title="Quick View">
                                <i class="fas fa-external-link-alt"></i>
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

            <ul class="pagination toolbox-item">
                <li class="page-item disabled">
                    <a class="page-link page-link-btn" href="category-4col.html#"><i class="icon-angle-left"></i></a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="category-4col.html#">1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="category-4col.html#">2</a></li>
                <li class="page-item"><a class="page-link" href="category-4col.html#">3</a></li>
                <li class="page-item"><span class="page-link">...</span></li>
                <li class="page-item">
                    <a class="page-link page-link-btn" href="category-4col.html#"><i class="icon-angle-right"></i></a>
                </li>
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

    {{-- Category--}}
    <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
        <div class="sidebar-wrapper">
            <div class="widget">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Danh Mục</a>
                </h3>

                <div class="collapse show" id="widget-body-2">
                    <div class="widget-body">
                        <ul class="cat-list">
                            @foreach ($categories->take(5) as $category)
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
                    <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Dung Lượng</a>
                </h3>

                <div class="collapse show" id="widget-body-3">
                    <div class="widget-body">
                        <ul class="cat-list">
                            @foreach ($Capacities->take(5) as $Capacity)
                            <li>
                                <a href="{{ route('products.filter', ['capacity_id' => $Capacity->id]) }}">{{ $Capacity->name }}</a>
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
                    <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Màu Sắc</a>
                </h3>

                <div class="collapse show" id="widget-body-4">
                    <div class="widget-body">
                        <ul class="cat-list">
                            @foreach ($colors->take(5) as $color)
                            <li>
                                <a href="{{ route('products.filter', ['color_id' => $color->id]) }}">{{ $color->name }}</a>
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
@endsection
