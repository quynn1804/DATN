<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products() {
        return $this->hasMany(ProductVariant::class, 'capacity_id');
    }
}
