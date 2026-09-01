<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_name_en',
        'subsubcategory_name_ar',
        'subsubcategory_slug_en',
        'subsubcategory_slug_ar',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }


}
