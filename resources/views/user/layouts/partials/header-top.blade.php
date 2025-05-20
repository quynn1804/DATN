<div class="container">
    <div class="header-left d-none d-sm-block">
        {{-- <p class="top-message text-uppercase">FREE Returns. Standard Shipping Orders $99+</p> --}}
    </div>
    <!-- End .header-left -->

    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
        <div class="header-dropdown dropdown-expanded d-none d-lg-block">
            <a href="demo4.html#">Links</a>
            <div class="header-menu">
                <ul>
                    @guest
                        <li>
                            <a href="{{ route('login') }}">Đăng Nhập</a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @else

                                    <li>
                                        <a href="{{ route('myAccount') }}">Tài Khoản</a>
                                    </li>

                                    <div>
                                        <li>
                                            <a href="#" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();
                                            localStorage.removeItem('conversation_id');">Đăng Xuất</a>
                                        </li>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                    @endguest


                </ul>
            </div>
            <!-- End .header-menu -->
        </div>
        <!-- End .header-dropown -->

        <span class="separator"></span>

        <span class="separator"></span>
        <!-- End .social-icons -->
    </div>
    <!-- End .header-right -->
</div>