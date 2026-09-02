<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'title',
        'comment',
        'status',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }

}
