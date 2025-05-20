<div class="container">
    <div class="header-left col-lg-2 w-auto pl-0">
        <button class="mobile-menu-toggler text-primary mr-2" type="button">
            <i class="fas fa-bars"></i>
        </button>
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('assets/images/menu/logo/2.png') }}" width="111" height="44" alt="Header Logo">
        </a>
    </div>
    <!-- End .header-left -->
    <div class="header-right w-lg-max">
        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
            <form action="{{ route('search') }}" method="GET">
                <div class="header-search-wrapper">
                    <input type="search" class="form-control" name="q" id="q"
                        placeholder="Tìm kiếm sản phẩm bạn yêu thích..." required>
                    <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                </div>
                <!-- End .header-search-wrapper -->
            </form>
        </div>
        <!-- End .header-search -->

        <div class="header-contact d-none d-lg-flex pl-4 pr-4">
            <img alt="phone" src="{{ asset('theme/client/images/phone.png') }}" width="30" height="30"
                class="pb-1">
            <h6>
                <span>Gọi cho tôi:</span>
                <a href="tel:#" class="text-dark font1">0368416230</a>
            </h6>
        </div>

        {{-- Login --}}

        @guest
            <a href="{{ route('login') }}" class="header-icon" title="Login">
                <i class="icon-user-2"></i>
            </a>
        @else
            <a href="{{ route('myAccount') }}" class="header-icon" title="{{ Auth::user()->name }}">
                <i class="icon-user-2"></i>
            </a>
        @endguest

        <div class="dropdown cart-dropdown">
            <a href="{{ route('cart') }}" title="Giỏ hàng" class="dropdown-toggle dropdown-arrow cart-toggle"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                <i class="minicart-icon"></i>
                <span class="cart-count badge-circle">
                    {{ \App\Models\Cart::where('user_id', auth()->id())->distinct('product_variant_id')->count('product_variant_id') ?? 0 }}
                </span>
            </a>

            <div class="cart-overlay"></div>

            <div class="dropdown-menu mobile-cart">
                <a href="#" title="Close (Esc)" class="btn-close">×</a>

                <div class="dropdownmenu-wrapper custom-scrollbar">
                    <div class="dropdown-cart-header">Giỏ Hàng</div>

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="dropdown-cart-products">
                        @php
                            $cartItems = \App\Models\Cart::with('productVariant.product')
                                ->where('user_id', Auth::id())
                                ->get();
                        @endphp

                        @if ($cartItems->count() > 0)
                            @foreach ($cartItems as $item)
                                <div class="product" data-id="{{ $item->id }}">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="{{ route('singleProduct', $item->productVariant->product->id) }}">
                                                {{ $item->productVariant->product->name }}
                                            </a>
                                        </h4>
                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">{{ $item->quantity }}</span> ×
                                            {{ number_format($item->price_at_time) }}đ
                                        </span>
                                    </div>
                                    <figure class="product-image-container">
                                        @php
                                            $product = $item->productVariant->product;
                                            $mainImage = null;

                                            if (is_array($product->images) && count($product->images) > 0) {
                                                $mainImage = $product->images[0];
                                            } elseif (
                                                is_array($item->productVariant->images) &&
                                                count($item->productVariant->images) > 0
                                            ) {
                                                $mainImage = $item->productVariant->images[0];
                                            }

                                            // Nếu $mainImage là path relative trong storage/app/public/images/...
                                            $mainImageUrl = $mainImage
                                                ? asset('storage/' . $mainImage)
                                                : asset('assets/images/default-image.png'); // ảnh mặc định khi không có ảnh
                                        @endphp
                                        <a href="{{ route('singleProduct', $product->id) }}" class="product-image">
                                            <img src="{{ $mainImageUrl }}" alt="{{ $product->name }}">
                                        </a>
                                    </figure>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center p-2">Giỏ hàng của bạn đang trống.</p>
                        @endif
                    </div>

                    <div class="dropdown-cart-total">
                        <span>Tổng Tiền:</span>
                        <span
                            class="cart-total-price float-right">{{ number_format(session('cart_total', 0)) }}đ</span>
                    </div>

                    <!-- JS xử lý xóa sản phẩm AJAX -->
                    <script>
                        document.querySelectorAll('.btn-remove').forEach(button => {
                            button.addEventListener('click', function(e) {
                                e.preventDefault();

                                if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) return;

                                const cartId = this.dataset.id;
                                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                const productElement = this.closest('.product');

                                fetch(`/cart/${cartId}`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': token,
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            _method: 'DELETE'
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            alert(data.message);

                                            // Xóa phần tử khỏi DOM
                                            if (productElement) productElement.remove();

                                            // Cập nhật tổng tiền
                                            const cartTotalElement = document.querySelector('.cart-total-price');
                                            if (cartTotalElement) cartTotalElement.textContent = data.cart_total + 'đ';

                                            // Nếu giỏ hàng trống, hiện thông báo
                                            const remainingProducts = document.querySelectorAll(
                                                '.dropdown-cart-products .product');
                                            if (remainingProducts.length === 0) {
                                                document.querySelector('.dropdown-cart-products').innerHTML =
                                                    '<p class="text-center p-2">Giỏ hàng của bạn đang trống.</p>';
                                            }
                                        } else {
                                            alert(data.message || 'Xóa sản phẩm thất bại!');
                                        }
                                    })
                                    .catch(() => alert('Lỗi server, vui lòng thử lại!'));
                            });
                        });
                    </script>



                    <div class="dropdown-cart-action">
                        <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Giỏ Hàng</a>
                        <a href="{{ route('checkout') }}" class="btn btn-dark btn-block">Thanh toán</a>
                    </div>
                </div>

                <!-- End .dropdownmenu-wrapper -->
            </div>
            <!-- End .dropdown-menu -->
        </div>
        <!-- End .dropdown -->
    </div>
    <!-- End .header-right -->
</div>
