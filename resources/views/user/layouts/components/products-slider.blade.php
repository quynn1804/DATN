@isset($products)

@php
if (!function_exists('formatPrice')) {
    function formatPrice($price) {
        return number_format($price, 0, ',', '.') . ' đ';
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($path, $default = 'images/default.png') {
        if ($path && file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }
        return asset($default); // ảnh mặc định
    }
}
@endphp

<div class="container">
    <h2 class="section-title">{{ $title }}</h2>

    <div class="products-slider owl-carousel owl-theme dots-top dots-small">
        @foreach ($products as $product)

        @php
        $mainImage = null;

        // Trường hợp sản phẩm đơn (có mảng images trực tiếp)
        if (is_array($product->images) && count($product->images) > 0) {
            $mainImage = $product->images[0];
        }
        // Trường hợp sản phẩm có biến thể
        elseif ($product->variants && $product->variants->count() > 0) {
            $firstVariant = $product->variants->first();
            if (is_array($firstVariant->images) && count($firstVariant->images) > 0) {
                $mainImage = $firstVariant->images[0];
            }
        }

        // fallback nếu không có ảnh
        $mainImageUrl = getImageUrl($mainImage);
    @endphp


            <div class="product-default">
                <figure>
                    <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                        <img src="{{ getImageUrl($mainImage) }}" alt="{{ $product->name }}" class="avatar sm rounded-pill me-3" height="280" width="280">
                    </a>

                    @if ($product->price_sale > 0)
                        <div class="label-group">
                            <div class="product-label label-sale">Sale</div>
                        </div>
                    @endif
                </figure>

                <div class="product-details">
                    <div class="category-list">
                        <a class="product-category">
                            {{ $product->category->name ?? 'Không có danh mục' }}
                        </a>
                    </div>

                    <h3 class="product-title">
                        <a href="{{ route('singleProduct', ['id' => $product->id]) }}">{{ $product->name }}</a>
                    </h3>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                    </div>

                    <div class="price-box">
                        @if ($product->product_type === 'single')
                        {{-- <hr> --}}
                        <p><strong>Giá:</strong> <span
                                class="product-price">{{ number_format($product->price, 0, ',', '.') }}
                                VNĐ</span></p>
                    @else
                        {{-- <hr> --}}
                        @php
                            $prices = $product->variants->pluck('price')->sort();
                            $minPrice = $prices->first();
                            $maxPrice = $prices->last();
                        @endphp
                        <p><strong>Giá:</strong>
                            <span class="product-price">



                                @if ($minPrice !== $maxPrice)
                                <span class="product-price">
                                    {{ formatPrice($maxPrice) }}
                                </span>
                                @endif

                                <del class="old-price">{{ formatPrice($minPrice) }}đ</del>
                                {{-- {{ number_format($minPrice, 0, ',', '.') }} VNĐ
                                @if ($minPrice !== $maxPrice)
                                    - {{ number_format($maxPrice, 0, ',', '.') }} VNĐ
                                @endif --}}
                            </span>
                        </p>
                    @endif
                    </div>

                    <div class="product-action">
                        <a href="#" title="Wishlist" class="btn-icon-wish">
                            <i class="icon-heart"></i>
                        </a>
                        <a href="{{ route('singleProduct', ['id' => $product->id]) }}" class="btn-icon btn-add-cart">
                            <i class="fa fa-arrow-right"></i>
                            <span>Xem Hàng</span>
                        </a>
                        <a class="btn-quickview" title="Quick View">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
@endisset
