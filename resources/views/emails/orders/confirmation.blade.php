@component('mail::message')
# 🎉 Cảm ơn bạn đã đặt hàng tại **Pinastore**!

Xin chào **{{ $order->name }}**,  
Chúng tôi đã nhận được đơn hàng của bạn. Dưới đây là thông tin chi tiết:

---

### 🧾 Thông tin đơn hàng
- **Mã đơn hàng:** {{ $order->order_code }}  
- **Ngày đặt:** {{ $order->created_at->format('d/m/Y H:i') }}  
- **Phương thức thanh toán:** {{ strtoupper($order->payment_method) }}

---

### 🛍️ Sản phẩm đã đặt
@component('mail::table')
| Sản phẩm | Số lượng | Giá | Thành tiền |
|----------|----------|-----|-------------|
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
| {{ $productName }}{!! $variantInfo !!} | {{ $item->quantity }} | {{ number_format($item->price_at_time) }}₫ | {{ number_format($item->total_price) }}₫ |
@endforeach
@endcomponent


---

### 💰 Tổng tiền thanh toán: **{{ number_format($order->total_money) }}₫**

---

> 📦 Chúng tôi sẽ sớm liên hệ với bạn để xác nhận và tiến hành giao hàng.

@component('mail::button', ['url' => url('/')])
Xem Thêm Sản Phẩm
@endcomponent

Nếu bạn có bất kỳ thắc mắc nào, hãy liên hệ với chúng tôi qua email hoặc hotline.

Trân trọng,  
**Đội ngũ PinaStore**

@endcomponent
