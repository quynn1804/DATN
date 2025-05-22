<div class="sticky-navbar">
    <div class="sticky-info">
        <a href="{{ route('home') }}">
            <i class="icon-home"></i>Trang chủ
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('pageCategory') }}" class="">
            <i class="icon-bars"></i>Danh sách sản phẩm
        </a>
    </div>

    <div class="sticky-info">
        <a href="{{ route('myAccount') }}" class="">
            <i class="icon-user-2"></i>Tài khoản của tôi
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('cart') }}" class="">
            <i class="icon-shopping-cart position-relative">
                <span class="cart-count badge-circle">
                    {{ \App\Models\Cart::where('user_id', auth()->id())->distinct('product_variant_id')->count('product_variant_id') ?? 0 }}
                </span>
            </i>Giỏ hàng
        </a>
    </div>
</div>
