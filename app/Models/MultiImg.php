<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiImg extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
