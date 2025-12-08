<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'id',
        'created_at',
        'user_id',
        'title',
        'sub_title',
        'description',
        'order_id',
    ];
}
