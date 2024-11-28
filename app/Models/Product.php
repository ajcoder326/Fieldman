<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'product_code',
        'status',
        'category_id',
        'base_price',
        'discount',
        'tax',
        'price',
        'stock',
        'images',
        'thumbnail',
        'created_by_id',
        'updated_by_id',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'product_id');
    }

    protected $casts = [
        'price' => 'double',
        'base_price' => 'double',
    ];
}
