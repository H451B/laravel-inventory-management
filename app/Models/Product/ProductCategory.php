<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function types()
    {
        return $this->hasMany(ProductType::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
