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
        'discount_value',
        'max_discount_amount',
        'min_order_value',
        'start',
        'end',
        'is_active'
    ];

    protected $dates = ['start', 'end'];

    public function isValid()
{
    return $this->is_active && now()->between($this->start, $this->end);
}


    public function applyDiscount($orderTotal)
    {
        if (!$this->isValid() || $orderTotal < $this->min_order_value) {
            return 0;
        }

        if ($this->discount_type === 'percentage') {
            $discount = ($orderTotal * $this->max_discount_amount) / 100;
        } else {
            $discount = $this->max_discount_amount;
        }

        return min($discount, $this->max_discount_amount);
    }

}
