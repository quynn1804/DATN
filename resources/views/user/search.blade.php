@extends('user.layouts.main')
@section('title')
    Tìm kiếm
@endsection
@section('content')
    <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>

    @if ($products->isEmpty())
        <p>Không tìm thấy sản phẩm nào.</p>
    @else
        <div class="row">
            <div class="col-lg-12">
                <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                    data-slick-options='{
                "slidesToShow": 4,
                "slidesToScroll": 1,
                "infinite": false,
                "arrows": true,
                "dots": false,
                "spaceBetween": 30
                }'
                    data-slick-responsive='[
                {"breakpoint":992, "settings": {
                "slidesToShow": 3
                }},
                {"breakpoint":768, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint":575, "settings": {
                "slidesToShow": 1
                }}
            ]'>
                    @foreach ($products as $product)
                        <div class="product-item">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                        <img class="primary-img" src="{{ asset('storage/' . $product->image) }}"
                                            style="width: 200px; height: 250px; object-fit: cover;"
                                            alt="{{ $product->name }}">
                                    </a>
                                    <span class="sticker">Hot</span>
                                </div>
                                <div class="product-content">
                                    <div class="product-desc_info">
                                        <h3 class="product-name">
                                            <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <div class="price-box">
                                            <span
                                                class="new-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                            @if ($product->old_price)
                                                <span class="old-price">
                                                    {{ number_format($product->old_price, 0, ',', '.') }}đ
                                                </span>
                                            @endif
                                        </div>
                                        <div class="sold-count mt-1">
                                            <strong>Đã bán: {{ $product->order_items_count ?? 0 }} sản phẩm</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>TẤT CẢ SẢN PHẨM</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                    "slidesToShow": 4,
                                    "slidesToScroll": 1,
                                    "infinite": false,
                                    "arrows": true,
                                    "dots": false,
                                    "spaceBetween": 30
                                    }'
                                data-slick-responsive='[
                                    {"breakpoint":992, "settings": {
                                    "slidesToShow": 3
                                    }},
                                    {"breakpoint":768, "settings": {
                                    "slidesToShow": 2
                                    }},
                                    {"breakpoint":575, "settings": {
                                    "slidesToShow": 1
                                    }}
                                ]'>
                                @foreach ($prd as $product)
                                    <div class="product-item">

                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                                    <img class="primary-img"
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        style="width: 200px; height: 250px; object-fit: cover;"
                                                        alt="{{ $product->name }}">
                                                </a>
                                                <span class="sticker">Mới</span>
                                                <div class="add-actions">
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                                            {{ $product->name }} </a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span class="new-price">
                                                            {{ number_format($product->price, 0, ',', '.') }}đ </span>
                                                        <span class="old-price">
                                                            {{ number_format($product->old_price, 0, ',', '.') }}đ </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
