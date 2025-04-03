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
                                    @if (Auth::check())
                                        <li>Xin chào, {{ Auth::user()->name }}</li>

                                        @if (Auth::user()->role_id == 1)
                                            <li><a href="{{ route('admin.statistic.index') }}">Trang Quản Trị</a></li>
                                        @endif

                                        <li><a href="{{ route('myAccount') }}">Tài khoản</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Đăng xuất tài khoản')">Đăng Xuất</button>
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                                        <li><a href="{{ route('register') }}">Đăng Ký</a></li>
                                    @endif
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
                                <form class="search-form" action="{{ route('search') }}" method="GET">
                                    <input type="text" name="q" placeholder="Nhập từ khóa..." required>
                                    <button class="search-button" type="submit"><i class="ion-ios-search"></i></button>
                                </form>
                            </div>
                            <div class="header-logo_area">
                                <a href="#">
                                    <img src="{{ asset('assets/images/menu/logo/2.png') }}" height="300px"
                                        alt="Header Logo">
                                </a>
                            </div>
                            <div class="header-right_area d-none d-lg-block">
                                <ul>
                                    <li class="minicart-wrap">
                                        <a href="{{ route('cart') }}" class="minicart-btn">
                                            <div class="minicart-count_area">
                                                <span class="item-count">
                                                    {{ \App\Models\Cart::where('user_id', auth()->id())->distinct('product_variant_id')->count('product_variant_id') ?? 0 }}
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
                                                <li class="dropdown-holder"><a href="{{ route('home') }}">Trang Chủ</a>

                                                </li>
                                                <li class="megamenu-holder position-static"><a
                                                        href="{{ route('pageCategory') }}">Sản phẩm <i
                                                            class="ion-chevron-down"></i></a>
                                                    <ul class="kenne-dropdown">
                                                        @foreach ($categories->take(5) as $category)
                                                            <li>
                                                                <a href="{{ route('products.filter', ['category_id' => $category->id]) }}"> {{ $category->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                </li>
                                                <li><a href="{{ route('contact') }}">Liên hệ</a></li>

                                                <li><a href="{{ route('about') }}">Giới thiệu</a></li>

                                                <li><a href="{{ route('products.topFavorites') }}">Top Sản Phẩm</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </header>
    <!-- Main Header Area End Here -->
