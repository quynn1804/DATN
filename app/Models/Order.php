<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_code',
        'user_id',
        'name',
        'phone',
        'address',
        'total_money',
        'payment_method'
    ];

    // Quan hệ: Một đơn hàng thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Một đơn hàng có nhiều sản phẩm trong order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Quan hệ: Một đơn hàng có nhiều trạng thái (nếu có bảng order_statuses)
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
