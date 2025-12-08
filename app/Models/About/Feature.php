<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'icon','title','description'
    ];
}
