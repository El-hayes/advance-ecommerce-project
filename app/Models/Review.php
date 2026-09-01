<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    } // End Function

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    } //End Function



}
