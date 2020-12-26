<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    protected $table = 'product_weights';

    protected $fillable = ['user_id','product_id','quantity', 'pcs','per_unit_price','price'];
}
