<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Admin</li>


            <li>
                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-chat">Trang chủ</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa-solid fa-chart-line"></i>
                    <span key="t-dashboards">Thống kê</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="{{ route('admin.statistical.products') }}" key="t-saas">
                            Thống kê sản phẩm
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('admin.statistical.users') }}" key="t-crypto">Thống kê người dùng</a>
                    </li> --}}
                </ul>
            </li>

            <li class="menu-title" key="t-administration">Quản lý</li>

            <li>
                <a href="{{ route('admin.categories.index') }}" class="waves-effect">
                    <i class="fas fa-list"></i>
                    <span key="t-categories">Danh mục sản phẩm</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products.index') }}" class="waves-effect">
                    <i class="bx bx-share-alt"></i>
                    <span key="t-products">Sản phẩm</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.account.index') }}" class="waves-effect">
                    <i class="bx bx-user"></i>
                    <span key="t-users">Quản lý tài khoản</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-orders">Đơn hàng</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.comments.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-comments">Bình luận</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contacts.index') }}" class="waves-effect">
                    <i class="bx bx-user"></i>
                    <span key="t-contact">Liên hệ</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.vouchers.index') }}" class="waves-effect">
                    <i class="fas fa-receipt"></i>
                    <span key="t-vouchers">Mã giảm giá</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.stock-imports.index') }}" class="waves-effect">
                    <i class="fas fa-receipt"></i>
                    <span key="t-stockimports">Quản Lý Nhập Kho </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.chats.index') }}" class="waves-effect">
                    <i class="bx bx-chat"></i>
                    <span key="t-vouchers">Tư vấn khách hàng</span>
                </a>
            </li>
        </ul>
    </div>
</div>
