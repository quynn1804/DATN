<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockImport extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'supplier_name', 'import_date', 'note', 'created_by'];

    public function items()
    {
        return $this->hasMany(StockImportItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
