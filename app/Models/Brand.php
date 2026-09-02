<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name_en',
        'brand_name_ar',
        'brand_slug_en',
        'brand_slug_ar',
        'brand_image',
    ];
}
