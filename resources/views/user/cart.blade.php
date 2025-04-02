@extends('user.layouts.main')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Giỏ Hàng</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Giỏ Hàng</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($cartItems->isEmpty())
                        <p>Giỏ hàng của bạn đang trống.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
                    @else
                        <div class="table-content table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Màu</th>
                                        <th>Dung lượng</th>
                                        <th>Đơn Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Tổng Tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->productVariant->product->name }}</td>
                                            <td><img src="{{ asset('assets/images/' . $item->productVariant->product->image) }}"
                                                    width="50"></td>
                                            <td>{{ $item->productVariant->color->name }}</td>
                                            <td>{{ $item->productVariant->capacity->name }}</td>
                                            <td>{{ number_format($item->price_at_time, 0, ',', '.') }} VND</td>
                                            <td>
                                                <div>
                                                    <button class="qtybutton dec" data-id="{{ $item->id }}">-</button>
                                                    <input class="cart-plus-minus-box quantity-input" type="text"
                                                        value="{{ $item->quantity }}" min="1"
                                                        max="{{ $item->productVariant->stock }}"
                                                        data-id="{{ $item->id }}">
                                                    <button class="qtybutton inc"
                                                        data-id="{{ $item->id }}">+</button><br>
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
                                            <td>
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash" title="Remove"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-page-total">
                            <h2>Tổng giỏ hàng</h2>
                            <ul>
                                <li>Tổng tiền: <span
                                        id="cart-total">{{ number_format(
                                            $cartItems->sum(function ($item) {
                                                return $item->price_at_time * $item->quantity;
                                            }),
                                            0,
                                            ',',
                                            '.',
                                        ) }}
                                        VND</span></li>
                            </ul>
                            <a href="{{ route('checkout') }}">Tiến hành thanh toán</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateCart(cartId, quantity) {
                let token = "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('cart.update', '') }}/" + cartId,
                    type: "PUT",
                    data: {
                        _token: token,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#total-" + cartId).text(response.new_total + " VND");
                            $("#cart-total").text(response.total_cart + " VND");
                        }
                    },
                    error: function() {
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
                    quantity += 0;
                } else if ($(this).hasClass("dec") && quantity > 1) {
                    quantity -= 0;
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

@yield('scripts')
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
</style>
@endsection
