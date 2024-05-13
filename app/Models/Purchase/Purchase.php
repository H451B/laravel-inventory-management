<?php

namespace App\Models\Purchase;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'code', 'payment'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
