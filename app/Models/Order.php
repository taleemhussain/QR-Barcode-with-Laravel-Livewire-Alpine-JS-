<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
