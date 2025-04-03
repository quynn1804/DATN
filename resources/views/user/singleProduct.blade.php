@extends('user.layouts.main')
@section('title')
    Chi tiết sản phẩm
@endsection
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Chi Tiết Sản Phẩm</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Chi Tiết Sản Phẩm</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="sp-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="sp-img_area">
                        <div class="sp-img_slider">
                            <div class="single-slide">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="sp-content">
                        <h3 class="sp-title">{{ $product->name }}</h3>
                        <p class="sp-price">
                            @if ($product->variants->count() > 0)
                                Giá từ: {{ number_format($product->variants->min('price'), 0, ',', '.') }} đ
                            @else
                                {{ number_format($product->price, 0, ',', '.') }} đ
                            @endif
                        </p>
                        <p class="sp-description">{{ $product->description }}</p>

                        {{-- Form thêm vào giỏ hàng --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Chọn màu sắc --}}
                            @if ($product->variants->count() > 0)
                                <div class="form-group">
                                    <label for="color">Chọn màu sắc:</label>
                                    <select name="color_id" id="color" class="form-control">
                                        @foreach ($product->variants->unique('color_id') as $variant)
                                            <option value="{{ $variant->color_id }}">
                                                {{ optional($variant->color)->name ?? 'Không có màu' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Chọn dung lượng --}}
                            @if ($product->variants->count() > 0)
                                <div class="form-group">
                                    <label for="capacity">Chọn dung lượng:</label>
                                    <select name="capacity_id" id="capacity" class="form-control">
                                        @foreach ($product->variants->unique('capacity_id') as $variant)
                                            <option value="{{ $variant->capacity_id }}">
                                                {{ optional($variant->capacity)->name ?? 'Không có dung lượng' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Nhập số lượng --}}
                            <div class="form-group mt-3">
                                <label for="quantity">Số lượng:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* CSS đẹp hơn cho bình luận */
        .comment-box {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .comment-box strong {
            color: #007bff;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #fdd835;
        }
    </style>

    <div id="reviews" class="tab-pane" role="tabpanel">



        {{-- Danh sách bình luận --}}
        <h3 class="fw-bold text-dark mt-4">Đánh giá sản phẩm {{ $product->name }}</h3>

        <div class="mt-3">
            @foreach ($product->comments as $comment)
                <div class="comment-box">
                    <p><strong>{{ $comment->user->name }}</strong>
                        <span class="text-warning">
                            {!! str_repeat('★', $comment->rating) !!}
                            {!! str_repeat('☆', 5 - $comment->rating) !!}
                        </span>
                    </p>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>SẢN PHẨM LIÊN QUAN</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="related-products" class="tab-pane active show" role="tabpanel">
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
                                    {"breakpoint":992, "settings": {"slidesToShow": 3}},
                                    {"breakpoint":768, "settings": {"slidesToShow": 2}},
                                    {"breakpoint":575, "settings": {"slidesToShow": 1}}
                                ]'>
    
                                @foreach ($relatedProducts as $related)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('singleProduct', ['id' => $related->id]) }}">
                                                    <img class="primary-img"
                                                        src="{{ asset('storage/' . $related->image) }}"
                                                        style="width: 200px; height: 250px; object-fit: cover;"
                                                        alt="{{ $related->name }}">
                                                </a>
                                                <span class="sticker">Mới</span>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name">
                                                        <a href="{{ route('singleProduct', ['id' => $related->id]) }}">
                                                            {{ $related->name }}
                                                        </a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span class="new-price">
                                                            {{ number_format($related->price, 0, ',', '.') }}đ 
                                                        </span>
                                                        <span class="old-price">
                                                            {{ number_format($related->old_price, 0, ',', '.') }}đ 
                                                        </span>
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
                                @foreach ($productt as $product)
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
