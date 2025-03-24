       <!-- Begin Kenne's Footer Area -->
       <div class="kenne-footer_area bg-white_color">
           <div class="footer-top_area">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-5">
                           <div class="newsletter-area">
                               <div class="newsletter-logo">
                                   <a href="#">
                                       <img src="{{ asset('assets/images/footer/logo/2.png') }}" alt="Logo"
                                           class="img-crop">
                                   </a>
                               </div>
                               <p class="short-desc">Đăng ký nhận bản tin của chúng tôi, Nhập địa chỉ email của bạn</p>
                               <div class="newsletter-form_wrap">
                                   <form
                                       action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                                       method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                       class="newsletters-form validate" target="_blank" novalidate>
                                       <div id="mc_embed_signup_scroll">
                                           <div id="mc-form" class="mc-form subscribe-form">
                                               <input id="mc-email" class="newsletter-input" type="email"
                                                   autocomplete="off" placeholder="Nhập địa chỉ email" />
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
                                       <h4>Mua Sắm</h4>
                                   </div>
                                   <div class="footer-widgets">
                                       <ul>
                                           <li><a href="{{ route('pageCategory') }}">Sản Phẩm</a></li>
                                           <li><a href="{{ route('cart') }}">Giỏ hàng của tôi</a></li>
                                           <li><a href="{{ route('products.topFavorites') }}">Danh sách mong muốn</a>
                                           </li>
                                           <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                                       </ul>
                                   </div>
                               </div>
                               <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="footer-widgets_title">
                                       <h4>Tài Khoản</h4>
                                   </div>
                                   <div class="footer-widgets">
                                       <ul>
                                           <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                                           <li><a href="{{ route('register') }}">Đăng kí</a></li>
                                           <li><a href="{{ route('contact') }}">Giúp đỡ</a></li>
                                           <li><a href="{{ route('contact') }}">Ủng hộ</a></li>
                                       </ul>
                                   </div>
                               </div>
                               <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="footer-widgets_title">
                                       <h4>Danh mục sản phẩm</h4>
                                   </div>
                                   <div class="footer-widgets">
                                    @foreach ($categories as $category)
                                        <div>
                                            <a href="{{ route('products.filter', ['category_id' => $category->id]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    @endforeach
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
                               <span>Copyright &copy; 2025 <a href="#">WD73.</a> All rights reserved.</span>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="payment">
                               <img src="{{ asset('assets/images/footer/logo/2.png') }}" width="80px"
                                   alt="Pina Store">
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- Kenne's Footer Area End Here -->
       <!-- Begin Kenne's Modal Area -->
       <div class="modal fade modal-wrapper" id="exampleModalCenter">
           <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-body">
                       <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                       <div class="modal-inner-area sp-area row">
                           <div class="col-lg-5">
                               <div class="sp-img_area">
                                   <div class="kenne-element-carousel sp-img_slider slick-img-slider"
                                       data-slick-options='{
                                "slidesToShow": 1,
                                "arrows": false,
                                "fade": true,
                                "draggable": false,
                                "swipe": false,
                                "asNavFor": ".sp-img_slider-nav"
                                }'>
                                       <div class="single-slide red">
                                           <img src="assets/images/product/1-1.jpg" alt="Kenne's Product Image">
                                       </div>
                                       <div class="single-slide orange">
                                           <img src="assets/images/product/1-2.jpg" alt="Kenne's Product Image">
                                       </div>
                                       <div class="single-slide brown">
                                           <img src="assets/images/product/2-1.jpg" alt="Kenne's Product Image">
                                       </div>
                                       <div class="single-slide umber">
                                           <img src="assets/images/product/2-2.jpg" alt="Kenne's Product Image">
                                       </div>
                                       <div class="single-slide black">
                                           <img src="assets/images/product/3-1.jpg" alt="Kenne's Product Image">
                                       </div>
                                       <div class="single-slide golden">
                                           <img src="assets/images/product/3-2.jpg" alt="Kenne's Product Image">
                                       </div>
                                   </div>
                                   <div class="kenne-element-carousel sp-img_slider-nav arrow-style-2 arrow-style-3"
                                       data-slick-options='{
                               "slidesToShow": 4,
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
                                           <img src="assets/images/product/1-1.jpg" alt="Kenne's Product Thumnail">
                                       </div>
                                       <div class="single-slide orange">
                                           <img src="assets/images/product/1-2.jpg" alt="Kenne's Product Thumnail">
                                       </div>
                                       <div class="single-slide brown">
                                           <img src="assets/images/product/2-1.jpg" alt="Kenne's Product Thumnail">
                                       </div>
                                       <div class="single-slide umber">
                                           <img src="assets/images/product/2-2.jpg" alt="Kenne's Product Thumnail">
                                       </div>
                                       <div class="single-slide black">
                                           <img src="assets/images/product/3-1.jpg" alt="Kenne's Product Thumnail">
                                       </div>
                                       <div class="single-slide golden">
                                           <img src="assets/images/product/3-2.jpg" alt="Kenne's Product Thumnail">
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-xl-7 col-lg-6">
                               <div class="sp-content">
                                   <div class="sp-heading">
                                       <h5><a href="#">Dolorem odio provident ut nihil</a></h5>
                                   </div>
                                   <div class="rating-box">
                                       <ul>
                                           <li><i class="ion-android-star"></i></li>
                                           <li><i class="ion-android-star"></i></li>
                                           <li><i class="ion-android-star"></i></li>
                                           <li class="silver-color"><i class="ion-android-star"></i></li>
                                           <li class="silver-color"><i class="ion-android-star"></i></li>
                                       </ul>
                                   </div>
                                   <div class="price-box">
                                       <span class="new-price new-price-2">$194.00</span>
                                       <span class="old-price">$241.00</span>
                                   </div>
                                   <div class="sp-essential_stuff">
                                       <ul>
                                           <li>Brands <a href="#">Buxton</a></li>
                                           <li>Product Code: <a href="#">Product 16</a></li>
                                           <li>Reward Points: <a href="#">100</a></li>
                                           <li>Availability: <a href="#">In Stock</a></li>
                                           <li>EX Tax: <a href="#"><span>$453.35</span></a></li>
                                           <li>Price in reward points: <a href="#">400</a></li>
                                       </ul>
                                   </div>
                                   <div class="color-list_area">
                                       <div class="color-list_heading">
                                           <h4>Available Options</h4>
                                       </div>
                                       <span class="sub-title">Color</span>
                                       <div class="color-list">
                                           <a href="#" class="single-color active" data-swatch-color="red">
                                               <span class="bg-red_color"></span>
                                               <span class="color-text">Red (+$150)</span>
                                           </a>
                                           <a href="#" class="single-color" data-swatch-color="orange">
                                               <span class="burnt-orange_color"></span>
                                               <span class="color-text">Orange (+$170)</span>
                                           </a>
                                           <a href="#" class="single-color" data-swatch-color="brown">
                                               <span class="brown_color"></span>
                                               <span class="color-text">Brown (+$120)</span>
                                           </a>
                                           <a href="#" class="single-color" data-swatch-color="umber">
                                               <span class="raw-umber_color"></span>
                                               <span class="color-text">Umber (+$125)</span>
                                           </a>
                                           <a href="#" class="single-color" data-swatch-color="black">
                                               <span class="black_color"></span>
                                               <span class="color-text">Black (+$125)</span>
                                           </a>
                                           <a href="#" class="single-color" data-swatch-color="golden">
                                               <span class="golden_color"></span>
                                               <span class="color-text">Golden (+$125)</span>
                                           </a>
                                       </div>
                                   </div>
                                   <div class="quantity">
                                       <label>Quantity</label>
                                       <div class="cart-plus-minus">
                                           <input class="cart-plus-minus-box" value="1" type="text">
                                           <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                           <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                       </div>
                                   </div>
                                   <div class="kenne-group_btn">
                                       <ul>
                                           <li><a href="cart.html" class="add-to_cart">Cart To Cart</a></li>
                                           <li><a href="cart.html"><i class="ion-android-favorite-outline"></i></a>
                                           </li>
                                           <li><a href="cart.html"><i class="ion-ios-shuffle-strong"></i></a></li>
                                       </ul>
                                   </div>
                                   <div class="kenne-tag-line">
                                       <h6>Tags:</h6>
                                       <a href="#">Scraf</a>,
                                       <a href="#">hoodie</a>,
                                       <a href="#">jacket</a>
                                   </div>
                                   <div class="kenne-social_link">
                                       <ul>
                                           <li class="facebook">
                                               <a href="https://www.facebook.com/" data-bs-toggle="tooltip"
                                                   target="_blank" title="Facebook">
                                                   <i class="fab fa-facebook"></i>
                                               </a>
                                           </li>
                                           <li class="twitter">
                                               <a href="https://twitter.com/" data-bs-toggle="tooltip"
                                                   target="_blank" title="Twitter">
                                                   <i class="fab fa-twitter-square"></i>
                                               </a>
                                           </li>
                                           <li class="youtube">
                                               <a href="https://www.youtube.com/" data-bs-toggle="tooltip"
                                                   target="_blank" title="Youtube">
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
       </div>
       <!-- Kenne's Modal Area End Here -->
       <!-- Scroll To Top Start -->
       <a class="scroll-to-top" href="#"><i class="ion-chevron-up"></i></a>
       <!-- Scroll To Top End -->

       </div>

       <!-- JS ============================================ -->

       <!-- jQuery JS -->
       <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
       <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
       <!-- Modernizer JS -->
       <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
       <!-- Bootstrap JS -->
       <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

       <!-- Slick Slider JS -->
       <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
       <!-- Barrating JS -->
       <script src="{{ asset('assets/js/plugins/jquery.barrating.min.js') }}"></script>
       <!-- Counterup JS -->
       <script src="{{ asset('assets/js/plugins/jquery.counterup.js') }}"></script>
       <!-- Nice Select JS -->
       <script src="{{ asset('assets/js/plugins/jquery.nice-select.js') }}"></script>
       <!-- Sticky Sidebar JS -->
       <script src="{{ asset('assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
       <!-- Jquery-ui JS -->
       <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
       <script src="{{ asset('assets/js/plugins/jquery.ui.touch-punch.min.js') }}"></script>
       <!-- Theia Sticky Sidebar JS -->
       <script src="{{ asset('assets/js/plugins/theia-sticky-sidebar.min.js') }}"></script>
       <!-- Waypoints JS -->
       <script src="{{ asset('assets/js/plugins/waypoints.min.js') }}"></script>
       <!-- jQuery Zoom JS -->
       <script src="{{ asset('assets/js/plugins/jquery.zoom.min.js') }}"></script>
       <!-- Timecircles JS -->
       <script src="{{ asset('assets/js/plugins/timecircles.js') }}"></script>

       <!-- Main JS -->
       <script src="{{ asset('assets/js/main.js') }}"></script>

       <style>
           .img-crop {
               width: 100%;
               /* Chiều rộng đầy đủ */
               height: 320px;
               /* Điều chỉnh chiều cao */
               object-fit: cover;
               /* Cắt ảnh, giữ tỷ lệ */
               object-position: center bottom;
               /* Căn ảnh từ trên xuống */
           }
       </style>

       </body>
