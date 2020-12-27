<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPriceRange extends Model
{
    protected $table = 'product_price_ranges';

    protected $fillable = ['user_id','product_id','from_number','from_unit','to_number','to_unit','selling_unit_price','unit_price'];
}

