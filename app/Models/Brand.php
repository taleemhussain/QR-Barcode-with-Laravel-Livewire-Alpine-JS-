<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $fillable = [
        'id',
        'title',
        'status',
        'image',
    ];
}
