<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'min_discount_amount',
        'max_discount_amount',
        'min_order_value',
        'start',
        'end',
        'is_active'
    ];

    public function isValid($cartTotal)
    {
        // Kiểm tra voucher còn hiệu lực
        if (!$this->is_active || now() < $this->start || now() > $this->end) {
            return ['status' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'];
        }

        // Kiểm tra giá trị đơn hàng tối thiểu
        if ($cartTotal < $this->min_order_value) {
            return ['status' => false, 'message' => 'Đơn hàng chưa đạt giá trị tối thiểu.'];
        }

        return ['status' => true, 'voucher' => $this];
    }

    public function calculateDiscount($cartTotal)
    {
        if ($this->discount_type === 'fixed') {
            $discount = $this->min_discount_amount;
        } else { // Percentage
            $discount = ($this->min_discount_amount / 100) * $cartTotal;
            if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
                $discount = $this->max_discount_amount;
            }
        }
        return $discount;
    }
}
