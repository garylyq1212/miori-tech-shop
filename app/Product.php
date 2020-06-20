<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}
