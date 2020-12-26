<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPriceRange extends Model
{
    protected $table = 'product_price_ranges';

    // protected $fillable = ['user_id','product_id','from_number','from_unit','to_number','to_unit','selling_unit_price','unit_price','discount_percent','discount_price','discount_type','final_price','part']; 

    protected $fillable = ['user_id','product_id','from_number','from_unit_id','to_number','to_unit_id','selling_unit_price','unit_price','discount','discount_type','final_price','unit_price','part']; 

    public function fromUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','from_unit_id');
    }

    public function toUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','to_unit_id');
    }
    
}

