@extends('user.layouts.main')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <h2>Shop Related</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Wishlist</li>
            </ul>
        </div>
    </div>
</div>
<!-- Kenne's Breadcrumb Area End Here -->
<!--Begin Kenne's Wishlist Area -->
<div class="kenne-wishlist_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="kenne-product_remove">remove</th>
                                    <th class="kenne-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="kenne-product-price">Unit Price</th>
                                    <th class="kenne-product-stock-status">Stock Status</th>
                                    <th class="kenne-cart_btn">add to cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="kenne-product_remove"><a href="#"><i class="fa fa-trash"
                                        title="Remove"></i></a></td>
                                    <td class="kenne-product-thumbnail"><a href="#"><img src="assets/images/product/small-size/1.jpg" alt="Kenne's Wishlist Thumbnail"></a>
                                    </td>
                                    <td class="kenne-product-name"><a href="#">Juma rema pola</a></td>
                                    <td class="kenne-product-price"><span class="amount">£23.39</span></td>
                                    <td class="kenne-product-stock-status"><span class="in-stock">in stock</span></td>
                                    <td class="kenne-cart_btn"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="kenne-product_remove"><a href="#"><i class="fa fa-trash"
                                        title="Remove"></i></a></td>
                                    <td class="kenne-product-thumbnail"><a href="#"><img src="assets/images/product/small-size/2.jpg" alt="Kenne's Wishlist Thumbnail"></a>
                                    </td>
                                    <td class="kenne-product-name"><a href="#">Suretin mipen ruma</a>
                                    </td>
                                    <td class="kenne-product-price"><span class="amount">£30.50</span></td>
                                    <td class="kenne-product-stock-status"><span class="in-stock">in stock</span></td>
                                    <td class="kenne-cart_btn"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="kenne-product_remove"><a href="#"><i class="fa fa-trash"
                                        title="Remove"></i></a></td>
                                    <td class="kenne-product-thumbnail"><a href="#"><img src="assets/images/product/small-size/3.jpg" alt="Kenne's Wishlist Thumbnail"></a>
                                    </td>
                                    <td class="kenne-product-name"><a href="#">Bag Goodscol model</a>
                                    </td>
                                    <td class="kenne-product-price"><span class="amount">£40.19</span></td>
                                    <td class="kenne-product-stock-status"><span class="out-stock">out stock</span></td>
                                    <td class="kenne-cart_btn"><a href="#">add to cart</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Kenne's Wishlist Area End Here -->

<!-- Begin Brand Area -->
<div class="brand-area ">
    <div class="container">
        <div class="brand-nav border-top ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kenne-element-carousel brand-slider slider-nav" data-slick-options='{
                        "slidesToShow": 6,
                        "slidesToScroll": 1,
                        "infinite": false,
                        "arrows": false,
                        "dots": false,
                        "spaceBetween": 30
                        }' data-slick-responsive='[
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
                                <img src="assets/images/brand/1.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/2.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/3.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/4.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/5.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/6.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/1.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/images/brand/2.png" alt="Brand Images">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection