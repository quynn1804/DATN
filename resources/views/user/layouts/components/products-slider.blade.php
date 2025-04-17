@isset($products)

@php
if (!function_exists('formatPrice')) {
function formatPrice($price) {
return number_format($price, 0, ',', '.') . ' đ';
}
}

if (!function_exists('getImageUrl')) {
function getImageUrl($path, $default = 'https://laravel.com/img/logomark.min.svg') {
if ($path && file_exists(public_path('storage/' . $path))) {
return asset('storage/' . $path);
}

return asset($default); // ảnh mặc định (đặt ở public/images/default.png)
}
}
@endphp

<div class="container">
    <h2 class="section-title">
        {{ $title }}
    </h2>

    <div class="products-slider owl-carousel owl-theme dots-top dots-small">
        @foreach ($products as $product)
        <div class="product-default">
            <figure>
                <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                    <img src="{{ getImageUrl($product->image)  }}" alt="{{ $product->name }}" class="avatar sm rounded-pill me-3" height="280" width="280">
                </a>
                @if ($product->price_sale > 0)
                <div class="label-group">
                    {{-- <div class="product-label label-hot">
                        {{ $product['type'] }}
                </div> --}}
                <div class="product-label label-sale">
                    Sale
                </div>
        </div>
        @endif
        </figure>
        <div class="product-details">
            <div class="category-list">
                <a class="product-category">
                    {{ $product->category->name }}
                </a>
            </div>
            <h3 class="product-title">
                <a href="{{ route('singleProduct', ['id' => $product->id]) }}">{{ $product->name }}</a>
            </h3>
            <div class="ratings-container">
                <div class="product-ratings">
                    <span class="ratings" style="width:80%"></span>
                    <!-- End .ratings -->
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <!-- End .product-ratings -->
            </div>
            <!-- End .product-container -->
            <div class="price-box">

                @if ($product->price_sale > 0)
                <del class="old-price">{{ formatPrice($product->price_regular) }}đ</del>
                @endif

                <span class="product-price">
                    {{ formatPrice($product->price) }}
                </span>
            </div>
            <!-- End .price-box -->
            <div class="product-action">
                <a href="#" title="Wishlist" class="btn-icon-wish">
                    <i class="icon-heart"></i>
                </a>
                <a href="{{ route('singleProduct', ['id' => $product->id]) }}" class="btn-icon btn-add-cart">
                    <i class="fa fa-arrow-right"></i>
                    <span>SELECT OPTIONS</span>
                </a>
                <a class="btn-quickview" title="Quick View">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        <!-- End .product-details -->
    </div>
    @endforeach

</div>
</div>
@endisset
