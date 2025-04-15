<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    use HasFactory;
    protected $fillable = ['image'];

    // Thiết lập quan hệ đa hình ngược
    public function thumbnailable()
    {
        return $this->morphTo();
    }
}
