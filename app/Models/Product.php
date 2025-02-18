<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image', 'quantity', 'status'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function variationCombinations()
    {
        return $this->hasMany(ProductVariationCombination::class);
    }
}
