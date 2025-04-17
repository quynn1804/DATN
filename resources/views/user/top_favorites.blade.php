@extends('user.layouts.master')
@section('title', 'Top 10 sản phẩm')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Top Sản Phẩm</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 main-content">
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
                    <!-- End .toolbox-item -->
                </div>
            </nav>

            @if($topProducts->isNotEmpty())
            <div class="row">

                @foreach($topProducts as $product)
                <div class="col-lg-3 col-sm-4 col-md-3">
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
    <!-- End .col-lg-3 -->
</div>
<!-- End .row -->
</div>
<!-- End .container -->

<div class="mb-4"></div>
<!-- margin -->
@endsection
