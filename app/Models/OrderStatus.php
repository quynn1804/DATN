<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'status',
        'note'
    ];

    // Quan hệ: Mỗi trạng thái thuộc về một đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
