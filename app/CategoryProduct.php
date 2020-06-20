<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
