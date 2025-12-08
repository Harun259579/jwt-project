<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
      protected $fillable = [
        'title','subtitle','hero_image','background_image'
    ];
}
