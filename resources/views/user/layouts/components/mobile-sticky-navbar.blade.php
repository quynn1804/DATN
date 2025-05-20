<div class="sticky-navbar">
    <div class="sticky-info">
        <a href="{{ route('home') }}">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('pageCategory') }}" class="">
            <i class="icon-bars"></i>Categories
        </a>
    </div>

    <div class="sticky-info">
        <a href="{{ route('myAccount') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('cart') }}" class="">
            <i class="icon-shopping-cart position-relative">
                <span class="cart-count badge-circle">3</span>
            </i>Cart
        </a>
    </div>
</div>
