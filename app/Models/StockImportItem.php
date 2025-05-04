<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockImportItem extends Model
{
    use HasFactory;
    protected $fillable = ['stock_import_id', 'product_id', 'product_variant_id', 'quantity', 'price_import'];

    public function stockImport()
    {
        return $this->belongsTo(StockImport::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

}
