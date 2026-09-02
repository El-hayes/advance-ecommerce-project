<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = [
        'category_name_en',
        'category_name_ar',
        'category_slug_en',
        'category_slug_ar',
        'category_icon',
    ];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

}
