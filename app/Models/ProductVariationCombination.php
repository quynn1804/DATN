<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationCombination extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'color_id', 'storage_id', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductVariation::class, 'color_id');
    }

    public function capacity()
    {
        return $this->belongsTo(ProductVariation::class, 'Capacity_id');
    }
}
