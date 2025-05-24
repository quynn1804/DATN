@component('mail::message')
# Chào {{ $order->name }}!

Đơn hàng của bạn (mã: **{{ $order->order_code }}**) đã được giao.

Nếu bạn hài lòng với sản phẩm, hãy để lại đánh giá để chúng tôi phục vụ bạn tốt hơn.

---

### 🛍️ Sản phẩm trong đơn hàng

@component('mail::table')
| Sản phẩm | Số lượng |
|----------|----------|
@foreach($order->orderDetails as $item)
@php
    $productName = $item->productVariant->product->name ?? 'Sản phẩm không xác định';
    $color = $item->productVariant->color->name ?? null;
    $capacity = $item->productVariant->capacity->name ?? null;

    $variantInfo = '';
    if ($color || $capacity) {
        $variantInfo = ' (';
        if ($color) $variantInfo .= 'Màu: ' . $color;
        if ($color && $capacity) $variantInfo .= ', ';
        if ($capacity) $variantInfo .= 'Dung lượng: ' . $capacity;
        $variantInfo .= ')';
    }
@endphp
| {{ $productName }}{!! $variantInfo !!} | {{ $item->quantity }} |
@endforeach
@endcomponent

---

@component('mail::button', ['url' => url("/user/orders/{$order->id}")])
👉 Đánh giá đơn hàng tại đây
@endcomponent

Nếu có sự cố, đừng ngần ngại [liên hệ với chúng tôi]({{ route('contact') }}).

Trân trọng,
Đội ngũ Pinastore
@endcomponent
