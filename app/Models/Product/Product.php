<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'unit_purchase_price',
        'unit_selling_price',
        'discount_percentage',
        'status',
        'qty',
        'expiry_date',
        'product_category_id',
        'product_type_id',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
