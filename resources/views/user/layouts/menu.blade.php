<div class="main-wrapper boxed-layout bg-white_color">
    <!-- Begin Loading Area -->
    <div class="loading">
        <div class="text-center middle">
            <span class="loader">
                <span class="loader-inner"></span>
            </span>
        </div>
    </div>
    <!-- Loading Area End Here -->

    <!-- Begin Main Header Area -->
    <header class="main-header_area">
        <div class="header-top_area d-none d-lg-block">
            <div class="container">
                <div class="header-top_nav">
                    <div class="row">
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="header-top_right">
                                    <ul>
                                            <li><a href="#"> Login | Logout</a></li>
                                            
                                            <li><a href="#">Đơn Hàng</a></li>
                                            <li><a href="#">Tài khoản</a></li>
                                            <li>
                                                <a href="#"> Logout</a>
                                            </li>  
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-middle_nav">
                            <div class="header-search_area d-none d-lg-block">
                                <form class="search-form" action="#" method="POST">
                                    <input type="text" name="keyword" placeholder="Nhập từ khóa..." required>
                                    <button class="search-button" type="submit"><i class="ion-ios-search"></i></button>
                                </form>
                            </div>
                            <div class="header-logo_area">
                                <a href="#">
                                    <img src="{{ asset('assets/images/menu/logo/2.png') }}" height="300px" alt="Header Logo">
                                </a>
                            </div>
                            <div class="header-right_area d-none d-lg-block">
                                <ul>
                                    <li class="minicart-wrap">
                                        <a href="#" class="minicart-btn ">
                                            <div class="minicart-count_area">
                                                <span class="item-count">
                                                    {{-- tổng sản phẩm --}}
                                                </span>
                                                <i class="ion-bag"></i>
                                            </div>
                                            <div class="minicart-front_text">
                                                <span>Giỏ hàng</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="header-bottom_area d-none d-lg-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-menu_area position-relative">
                                        <nav class="main-nav d-flex justify-content-center">
                                            <ul>
                                                <li class="dropdown-holder"><a href="">Trang chủ</a>

                                                </li>
                                                <li class="megamenu-holder position-static"><a href="#">Sản phẩm <i class="ion-chevron-down"></i></a>
                                                    <ul class="kenne-dropdown">
                                                        <li>IPHONE</li>
                                                        <li>SAMSUNG</li>
                                                        <li>HUAWEI</li>
                                                        <li>OPPO</li>
                                                    </ul>
                                                </li>

                                                </li>
                                                <li><a href="#">Liên hệ</a></li>

                                                <li><a href="#">Giới thiệu</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </header>
    <!-- Main Header Area End Here -->