<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
      protected $fillable = [
        'title','email','button_text','button_link','banner_image'
    ];
}
