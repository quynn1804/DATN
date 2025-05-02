<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Dashboards</li>


            <li>
                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-chat">Trang chủ</span>
                </a>
            </li>

            <li class="menu-title" key="t-administration">Administration</li>

            <li>
                <a href="{{ route('admin.categories.index') }}" class="waves-effect">
                    <i class="fas fa-list"></i>
                    <span key="t-categories">Quản Lý Danh mục</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products.index') }}" class="waves-effect">
                    <i class="bx bx-share-alt"></i>
                    <span key="t-products">Quản Lý Sản phẩm</span>
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
                    <span key="t-orders">Quản Lý Đơn hàng</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.comments.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-comments">Quản Lý Bình luận</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contacts.index') }}" class="waves-effect">
                    <i class="bx bx-user"></i>
                    <span key="t-contact">Quản Lý Liên hệ</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.vouchers.index') }}" class="waves-effect">
                    <i class="fas fa-receipt"></i>
                    <span key="t-vouchers">Quản Lý Voucher</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.stock-imports.index') }}" class="waves-effect">
                    <i class="fas fa-receipt"></i>
                    <span key="t-stockimports">Quản Lý Nhập Kho </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
