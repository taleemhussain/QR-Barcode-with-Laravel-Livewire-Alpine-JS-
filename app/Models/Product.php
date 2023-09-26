<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id',
        'title',
        'price',
        'description',
        'quantity',
        'status',
        'brand_id',
        'category_id',
        'warehouse_id',
        'sku',
        'image'
    ];
    

}
