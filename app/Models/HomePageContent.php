<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $table = 'homepage_contents';

    protected $fillable = [
    'page',
    'section',
    'title',
    'sub_title',
    'image',
    'video',
    'description',
    'sub_description',
    'main_text',
    'sub_text',
    'button_text',
    'sub_button_text',
    'link_url',
    'email',
    'phone',
    'location',
    'status',
];


}
