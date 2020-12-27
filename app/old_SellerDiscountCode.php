<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerDiscountCode extends Model
{
    protected $table = 'seller_discount_codes';
   protected $fillable = ['user_id','discount_code','discount_value','discount_type','offer_start_date','offer_end_date','product_id','status','minimum_purchase_amount'];
}
