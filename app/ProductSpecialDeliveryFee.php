<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecialDeliveryFee extends Model
{
    protected $table = 'product_special_delivery_fees';

    protected $fillable = ['user_id','product_id','from_price','to_price','delivery_type','amount','part']; 
}
