<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'image', 'quantity', 'status'
        ,'category_id'];

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
