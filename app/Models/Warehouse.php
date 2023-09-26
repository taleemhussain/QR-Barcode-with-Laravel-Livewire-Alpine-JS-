<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $fillable = [
        'id',
        'title',
        'status',
        'image',
    ];
}
