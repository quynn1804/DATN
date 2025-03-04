@extends('user.layouts.main')
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
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Single Product Area -->
    <div class="sp-area">
        <div class="container">
            <div class="sp-nav">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sp-img_area">
                            <div class="sp-img_slider slick-img-slider kenne-element-carousel"
                                data-slick-options='{
                        "slidesToShow": 1,
                        "arrows": false,
                        "fade": true,
                        "draggable": false,
                        "swipe": false,
                        "asNavFor": ".sp-img_slider-nav"
                        }'>
                                <div class="single-slide red zoom">
                                    <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}">
                                </div>
                                {{-- <div class="single-slide orange zoom">
                                    <img src="assets/images/product/1-2.jpg" alt="Kenne's Product Image">
                                </div>
                                <div class="single-slide brown zoom">
                                    <img src="assets/images/product/2-1.jpg" alt="Kenne's Product Image">
                                </div>
                                <div class="single-slide umber zoom">
                                    <img src="assets/images/product/2-2.jpg" alt="Kenne's Product Image">
                                </div>
                                <div class="single-slide black zoom">
                                    <img src="assets/images/product/3-1.jpg" alt="Kenne's Product Image">
                                </div>
                                <div class="single-slide green zoom">
                                    <img src="assets/images/product/3-2.jpg" alt="Kenne's Product Image">
                                </div> --}}
                            </div>
                            <div class="sp-img_slider-nav slick-slider-nav kenne-element-carousel arrow-style-2 arrow-style-3"
                                data-slick-options='{
                        "slidesToShow": 3,
                        "asNavFor": ".sp-img_slider",
                        "focusOnSelect": true,
                        "arrows" : true,
                        "spaceBetween": 30
                        }'
                                data-slick-responsive='[
                                {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                {"breakpoint":575, "settings": {"slidesToShow": 2}}
                            ]'>
                                <div class="single-slide red">
                                    <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}">
                                </div>
                                {{-- <div class="single-slide orange">
                                    <img src="assets/images/product/1-2.jpg" alt="Kenne's Product Thumnail">
                                </div>
                                <div class="single-slide brown">
                                    <img src="assets/images/product/2-1.jpg" alt="Kenne's Product Thumnail">
                                </div>
                                <div class="single-slide umber">
                                    <img src="assets/images/product/2-2.jpg" alt="Kenne's Product Thumnail">
                                </div>
                                <div class="single-slide red">
                                    <img src="assets/images/product/3-1.jpg" alt="Kenne's Product Thumnail">
                                </div>
                                <div class="single-slide orange">
                                    <img src="assets/images/product/3-2.jpg" alt="Kenne's Product Thumnail">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="sp-content">
                            <div class="sp-heading">
                                <h5><a href="#">{{ $product->name }}</a></h5>
                            </div>
                            {{-- <span class="reference">Reference: demo_1</span> --}}
                            <div class="rating-box">
                                <ul>
                                    <li><i class="ion-android-star"></i></li>
                                    <li><i class="ion-android-star"></i></li>
                                    <li><i class="ion-android-star"></i></li>
                                    <li class="silver-color"><i class="ion-android-star"></i></li>
                                    <li class="silver-color"><i class="ion-android-star"></i></li>
                                </ul>
                            </div>
                            <div class="sp-essential_stuff">
                                <ul>
                                    <li>Danh Mục: <a href="javascript:void(0)">IPHONE</a></li>
                                    <li>Mã Sản Phẩm: <a href="javascript:void(0)">Product 16</a></li>
                                    <li>Giá : <a href="javascript:void(0)">
                                            <span id="updatedPrice">
                                                {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="product-size_box">
                                    <span>Màu</span>
                                    @foreach ($colors as $color)
                                        <label>
                                            <input type="radio" name="color" value="{{ $color->id }}">
                                            {{ $color->name }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="capacity">
                                    <label>Dung Lượng</label>
                                    @foreach ($capacities as $capacity)
                                        <label>
                                            <input type="radio" name="capacity" value="{{ $capacity->id }}">
                                            {{ $capacity->name }}
                                        </label>
                                    @endforeach
                                </div>

                                <!-- Ẩn danh sách biến thể để JavaScript xử lý -->
                                <input type="hidden" id="variantsData" value="{{ json_encode($product->variants) }}">

                                <div class="quantity">
                                    <label>Số Lượng</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <div class="qty-btn_area">
                                    <ul>
                                        <li><a class="qty-cart_btn" href="cart.html">Thêm Vào Giỏ Hàng</a></li>
                                        <li><a class="qty-wishlist_btn" href="wishlist.html" data-bs-toggle="tooltip"
                                                title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                        </li>
                                        <li><a class="qty-compare_btn" href="compare.html" data-bs-toggle="tooltip"
                                                title="Compare This Product"><i class="ion-ios-shuffle-strong"></i></a></li>
                                    </ul>
                                    <div class="kenne-social_link">
                                        <ul>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com/" data-bs-toggle="tooltip" target="_blank"
                                                    title="Facebook">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="https://twitter.com/" data-bs-toggle="tooltip" target="_blank"
                                                    title="Twitter">
                                                    <i class="fab fa-twitter-square"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com/" data-bs-toggle="tooltip" target="_blank"
                                                    title="Youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-bs-toggle="tooltip"
                                                    target="_blank" title="Google Plus">
                                                    <i class="fab fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://rss.com/" data-bs-toggle="tooltip" target="_blank"
                                                    title="Instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kenne's Single Product Area End Here -->

            <!-- Begin Product Tab Area Two -->
            <div class="product-tab_area-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sp-product-tab_nav">
                                <div class="product-tab">
                                    <ul class="nav product-menu">
                                        <li><a class="active" data-bs-toggle="tab" href="#description"><span>Mô
                                                    Tả</span></a>
                                        </li>
                                        <li><a data-bs-toggle="tab" href="#reviews"><span>Bình Luận</span></a></li>
                                    </ul>
                                </div>
                                <div class="tab-content uren-tab_content">
                                    <div id="description" class="tab-pane active show" role="tabpanel">
                                        <div class="product-description">
                                            <ul>
                                                <li>
                                                    {{ $product->description }}

                                            </ul>
                                        </div>
                                    </div>
                                    {{-- bình luận --}}
                                    <div id="reviews" class="tab-pane" role="tabpanel">
                                        <div class="tab-pane active" id="tab-review">
                                            <form class="form-horizontal" id="form-review">
                                                <div id="review">
                                                    <table class="table table-striped table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 50%;"><strong>Customer</strong></td>
                                                                <td class="text-right">26/10/19</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p>Good product! Thank you very much</p>
                                                                    <div class="rating-box">
                                                                        <ul>
                                                                            <li><i class="ion-android-star"></i></li>
                                                                            <li><i class="ion-android-star"></i></li>
                                                                            <li><i class="ion-android-star"></i></li>
                                                                            <li><i class="ion-android-star"></i></li>
                                                                            <li><i class="ion-android-star"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <h2>Viết bài bình luận</h2>
                                                <div class="form-group required">
                                                    <div class="col-sm-12 p-0">
                                                        <label>Email của bạn<span class="required">*</span></label>
                                                        <input class="review-input" type="email" name="con_email"
                                                            id="con_email" required>
                                                    </div>
                                                </div>
                                                <div class="form-group required second-child">
                                                    <div class="col-sm-12 p-0">
                                                        <label class="control-label">Chia sẻ ý kiến ​​của bạn</label>
                                                        <textarea class="review-textarea" name="con_message" id="con_message"></textarea>
                                                        {{-- <div class="help-block"><span class="text-danger">Note:</span>
                                                            HTML is
                                                            not
                                                            translated!</div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group last-child required">
                                                    {{-- <div class="col-sm-12 p-0">
                                                        <div class="your-opinion">
                                                            <label>Your Rating</label>
                                                            <span>
                                                                <select class="star-rating">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                    </div> --}}
                                                    <div class="kenne-btn-ps_right">
                                                        <button class="kenne-btn">Gửi Bình Luận</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Tab Area Two End Here -->

            <!-- Begin Product Area -->
            <div class="product-area pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title">
                                <h3>Sản Phẩm Bán Chạy</h3>
                                <div class="product-arrow"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="kenne-element-carousel product-slider slider-nav"
                                data-slick-options='{
                "slidesToShow": 4,
                "slidesToScroll": 1,
                "infinite": false,
                "arrows": true,
                "dots": false,
                "spaceBetween": 30,
                "appendArrows": ".product-arrow"
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
                                {{-- forrrr --}}
                                @foreach ($productt as $product)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                                    <img class="primary-img"
                                                        src="{{ asset('assets/images/' . $product->image) }}" 
                                                        height="180px" alt="{{ $product->name }}">
                                                </a>
                                                <span class="sticker-2">Hot</span>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name"><a href="{{ route('singleProduct', ['id' => $product->id]) }}">{{$product->name}}</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span class="new-price">{{$product->price}}VND</span>
                                                        {{-- <span class="old-price">$50.99</span> --}}
                                                    </div>
                                                    {{-- đánh giá sao --}}
                                                    {{-- <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div> --}}
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
            <!-- Product Area End Here -->

            <!-- Begin Brand Area -->
            <div class="brand-area ">
                <div class="container">
                    <div class="brand-nav border-top ">
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
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/1.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/2.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/3.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/4.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/5.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/6.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/1.png') }}" alt="Brand Images">
                                        </a>
                                    </div>
                                    <div class="brand-item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('assets/images/brand/2.png') }}" alt="Brand Images">
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let updatedPrice = document.getElementById("updatedPrice");

                    // Lấy danh sách biến thể từ input ẩn
                    let variants = JSON.parse(document.getElementById("variantsData").value);

                    function updatePrice() {
                        let selectedColor = document.querySelector('input[name="color"]:checked')?.value;
                        let selectedCapacity = document.querySelector('input[name="capacity"]:checked')?.value;

                        if (selectedColor && selectedCapacity) {
                            // Tìm biến thể phù hợp với màu và dung lượng đã chọn
                            let variant = variants.find(v => v.color_id == selectedColor && v.capacity_id ==
                                selectedCapacity);

                            if (variant) {
                                updatedPrice.innerText = parseInt(variant.price).toLocaleString('vi-VN') + " VND";
                            }
                        }
                    }

                    // Lắng nghe sự kiện thay đổi của radio button
                    document.querySelectorAll('input[type="radio"]').forEach(input => {
                        input.addEventListener("change", updatePrice);
                    });
                });
            </script>
            <!-- Brand Area End Here -->
        @endsection
