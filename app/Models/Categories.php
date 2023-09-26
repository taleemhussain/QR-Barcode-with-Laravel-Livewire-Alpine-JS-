<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'id',
        'title',
        'status',
        'image',
    ];
}
