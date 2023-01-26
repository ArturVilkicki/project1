<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getStock()
    {
        return $this->hasOne('App\Models\Stock', 'sku', 'sku');
    }

    public function tag()
    {
        return $this->hasMany('App\Models\Tag', 'product_id', 'id');
    }

}
