<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogPostCategory;

class BlogPost extends Model
{
    protected $guarded  = [];

    public function postCategory()
    {
        return  $this->belongsTo(BlogPostCategory::class, 'category_id', 'id');
    } // End Method


}
