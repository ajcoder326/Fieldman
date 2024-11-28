<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
        'created_by_id',
        'updated_by_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
