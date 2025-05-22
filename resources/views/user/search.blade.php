@extends('user.layouts.master')
@section('title')
{{ $keyword }}
@endsection
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
    @php
        if (!function_exists('formatPrice')) {
            function formatPrice($price)
            {
                return number_format($price, 0, ',', '.') . ' VNĐ';
            }
        }
    @endphp
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $keyword }}</li>
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

                            {{-- {{ $products->links('pagination::bootstrap-5') }} --}}

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
