@php
if (!function_exists('getImageUrl')) {
function getImageUrl($path, $default = 'https://laravel.com/img/logomark.min.svg') {

$fullPath = public_path('assets/images/' . $path);
if (file_exists($fullPath) && !is_dir($fullPath)) {
return asset('assets/images/' . $path);
}

return asset($default);
}
}
@endphp


@extends('user.layouts.master')
@section('title', 'Cart')

@section('style')
<style>
    .cart-plus-minus {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        width: 120px;
        justify-content: space-between;
    }

    .cart-plus-minus-box {
        width: 50px;
        text-align: center;
        border: none;
        background: transparent;
        font-size: 16px;
    }

    .qtybutton {
        background: #ddd;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
        border: none;
    }

    .btn-remove {
        cursor: pointer;
    }

</style>
@endsection

@section('content')
<div class="container">
    <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
        <li class="active">
            <a href="{{ route('cart') }}">Giỏ Hàng</a>
        </li>
        <li style="pointer-events: none">
            <a href="#">Thanh Toán</a>
        </li>
        <li class="disabled">
            <a href="cart.html">Thanh Toán Thành Công</a>
        </li>
    </ul>

    @if ($cartItems->isEmpty())
    <div style="height: 100vh" class="d-flex justify-content-center align-items-center">
        <h2 class="fst-italic text-danger">
            Bạn chưa có sản phẩm nào. <a href="{{ route('pageCategory') }}">Mua Hàng</a>
        </h2>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12">
            <div class="cart-table-container">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="name-col">Sản phẩm</th>
                            <th class="color-col">Màu</th>
                            <th class="size-col">Dung lượng</th>
                            <th class="price-col">Giá</th>
                            <th class="qty-col">Số lượng</th>
                            <th class="total-col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="{{ route('singleProduct', $item->productVariant->product->id) }}" class="product-image">
                                        <img src="{{ getImageUrl($item->productVariant->product->image) }}" alt="Product">
                                    </a>

                                    <a class="btn-remove icon-cancel" onclick="event.preventDefault();
                                document.getElementById('delete-product-{{ $item->id }}').submit();" title="Remove Product"></a>

                                    <form id="delete-product-{{ $item->id }}" action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </figure>
                            </td>
                            <td class="product-col">
                                <h5 class="product-title">
                                    <a href="{{ route('singleProduct', $item->productVariant->product->id) }}">
                                        {{ $item->productVariant->product->name }}
                                    </a>
                                </h5>
                            </td>
                            <td>
                                {{ $item->productVariant->color->name }}
                            </td>
                            <td>
                                {{ $item->productVariant->capacity->name }}
                            </td>
                            <td>
                                {{ number_format($item->price_at_time, 0, ',', '.') }}đ
                            </td>

                            <td>
                                <div>
                                    <button class="qtybutton dec" data-id="{{ $item->id }}">-</button>
                                    <input class="cart-plus-minus-box quantity-input" type="text" value="{{ $item->quantity }}" min="1" max="{{ $item->productVariant->stock }}" data-id="{{ $item->id }}">
                                    <button class="qtybutton inc" data-id="{{ $item->id }}">+</button><br>
                                    <span style="color: red">còn {{ $item->productVariant->stock }} sản
                                        phẩm</span>
                                </div>
                            </td>

                            <td>
                                <span class="total-price" id="total-{{ $item->id }}">
                                    {{ number_format($item->price_at_time * $item->quantity, 0, ',', '.') }}
                                    VND
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="cart-summary">
                <h3>TOTALS</h3>

                <table class="table table-totals">
                    <tfoot>
                        <tr>
                            <td>Tổng Tiền:</td>
                            <td id="cart-total">
                                {{ number_format(
                                    $cartItems->sum(function ($item) {
                                        return $item->price_at_time * $item->quantity;
                                    }),
                                    0,
                                    ',',
                                    '.',
                                ) }}VND
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="checkout-methods">
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-dark">
                        Thanh Toán
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div><!-- End .cart-summary -->
        </div><!-- End .col-lg-4 -->
    </div>
    @endif

</div>


<div class="mb-6"></div><!-- margin -->
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function updateCart(cartId, quantity) {
            let token = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ route('cart.update', '') }}/" + cartId
                , type: "PUT"
                , data: {
                    _token: token
                    , quantity: quantity
                }
                , success: function(response) {
                    if (response.success) {
                        $("#total-" + cartId).text(response.new_total + " VND");
                        $("#cart-total").text(response.total_cart + " VND");
                    }
                }
                , error: function() {
                    alert("Có lỗi xảy ra! Vui lòng thử lại.");
                }
            });
        }

        $(".qtybutton").on("click", function(e) {
            e.preventDefault();

            let cartId = $(this).data("id");
            let inputField = $("input[data-id='" + cartId + "']");
            let quantity = parseInt(inputField.val());
            let maxStock = parseInt(inputField.attr("max")); // Lấy số lượng tối đa từ max="stock"

            if ($(this).hasClass("inc") && quantity < maxStock) {
                quantity += 1;
            } else if ($(this).hasClass("dec") && quantity > 1) {
                quantity -= 1;
            }

            inputField.val(quantity).trigger("change"); // Kích hoạt sự kiện change để cập nhật cart
        });

        // Xử lý khi nhập số lượng trực tiếp
        $(".quantity-input").on("input", function() {
            let cartId = $(this).data("id");
            let quantity = parseInt($(this).val());
            let maxStock = parseInt($(this).attr("max")); // Lấy số lượng tối đa từ max="stock"

            if (!quantity || quantity < 1) {
                $(this).val(1);
                quantity = 1;
            } else if (quantity > maxStock) {
                $(this).val(maxStock);
                quantity = maxStock;
            }

            updateCart(cartId, quantity);
        });

        // Xử lý khi người dùng rời khỏi ô input
        $(".quantity-input").on("change", function() {
            let cartId = $(this).data("id");
            let quantity = parseInt($(this).val());
            let maxStock = parseInt($(this).attr("max")); // Lấy số lượng tối đa từ max="stock"

            if (!quantity || quantity < 1) {
                $(this).val(1);
                quantity = 1;
            } else if (quantity > maxStock) {
                $(this).val(maxStock);
                quantity = maxStock;
            }

            updateCart(cartId, quantity);
        });
    });

</script>

@endsection
