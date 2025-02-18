<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model {
    use HasFactory;

    protected $fillable = ['product_id', 'color_id', 'capacity_id', 'price', 'stock'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function capacity() {
        return $this->belongsTo(Capacity::class);
    }
}
