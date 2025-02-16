@extends(' user.layouts.main')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <h2>Shop Related</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Cart</li>
            </ul>
        </div>
    </div>
</div>
<!-- Kenne's Breadcrumb Area End Here -->
<!-- Begin Uren's Cart Area -->
<div class="kenne-cart-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="kenne-product-remove">remove</th>
                                    <th class="kenne-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="kenne-product-price">Unit Price</th>
                                    <th class="kenne-product-quantity">Quantity</th>
                                    <th class="kenne-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="kenne-product-remove"><a href="#"><i class="fa fa-trash"
                                        title="Remove"></i></a></td>
                                    <td class="kenne-product-thumbnail"><a href="#"><img src="assets/images/product/small-size/1.jpg" alt="Uren's Cart Thumbnail"></a></td>
                                    <td class="kenne-product-name"><a href="#">Juma rema pola</a></td>
                                    <td class="kenne-product-price"><span class="amount">$46.80</span></td>
                                    <td class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount">$46.80</span></td>
                                </tr>
                                <tr>
                                    <td class="kenne-product-remove"><a href="#"><i class="fa fa-trash"
                                        title="Remove"></i></a></td>
                                    <td class="kenne-product-thumbnail"><a href="#"><img src="assets/images/product/small-size/2.jpg" alt="Uren's Cart Thumbnail"></a></td>
                                    <td class="kenne-product-name"><a href="#">Bag Goodscol model</a>
                                    </td>
                                    <td class="kenne-product-price"><span class="amount">$71.80</span></td>
                                    <td class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount">$71.80</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </div>
                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal <span>$118.60</span></li>
                                    <li>Total <span>$118.60</span></li>
                                </ul>
                                <a href="#">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Uren's Cart Area End Here -->

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
<!-- Brand Area End Here -->

<!-- Begin Kenne's Footer Area -->
<div class="kenne-footer_area bg-smoke_color">
    <div class="footer-top_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="newsletter-area">
                        <div class="newsletter-logo">
                            <a href="#">
                                <img src="assets/images/footer/logo/1.png" alt="Logo">
                            </a>
                        </div>
                        <p class="short-desc">Subscribe to our newsleter, Enter your emil address</p>
                        <div class="newsletter-form_wrap">
                            <form action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="newsletters-form validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <div id="mc-form" class="mc-form subscribe-form">
                                        <input id="mc-email" class="newsletter-input" type="email" autocomplete="off" placeholder="Enter email address" />
                                        <button class="newsletter-btn" id="mc-submit"><i
                                        class="ion-android-mail"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="row footer-widgets_wrap">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>Shopping</h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    <li><a href="#">Product</a></li>
                                    <li><a href="#">My Cart</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">Cart</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>Account</h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="#">Register</a></li>
                                    <li><a href="#">Help</a></li>
                                    <li><a href="#">Support</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>Categories</h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Jeans</a></li>
                                    <li><a href="#">Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright">
                        <span>Copyright &copy; 2023 <a href="#">Kenne.</a> All rights reserved.</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="payment">
                        <img src="assets/images/footer/payment/1.png" alt="Kenne's Payment Method">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kenne's Footer Area End Here -->
<!-- Scroll To Top Start -->
<a class="scroll-to-top" href="#"><i class="ion-chevron-up"></i></a>
<!-- Scroll To Top End -->
@endsection