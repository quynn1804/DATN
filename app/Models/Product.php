<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'images', 'quantity', 'status'
        ,'category_id','product_type','color_id',
        'capacity_id',];

        protected $casts = [
            'images' => 'array',
        ];
    public function thumbnails()
    {
    return $this->morphMany(Thumbnail::class, 'thumbnailable');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // Quan hệ với màu sắc (chỉ áp dụng cho sản phẩm đơn)
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    // Quan hệ với dung lượng (chỉ áp dụng cho sản phẩm đơn)
    public function capacity()
    {
        return $this->belongsTo(Capacity::class, 'capacity_id');
    }
    public function orderDetails()
    {
    return $this->hasMany(OrderDetail::class, 'product_variant_id', 'id');
    }

    public static function topFavoriteProducts($limit = 10)
    {
        return self::withCount(['orderDetails' => function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDays(30));
        }])

        ->orderByDesc('order_details_count')
        ->limit($limit)
        ->get();
    }

}
