<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerDiscountCode extends Model
{
    protected $table = 'seller_discount_codes';
    protected $fillable = ['user_id','discount_code','discount_value','discount_type','offer_start_date','offer_end_date','status','minimum_purchase_amount','products','seller_item_codes','product_bar_codes'];
    
    public function discountedProducts(){
      return $this->hasMany('App\DiscountedProduct','seller_discount_code_id','id');
    }

    

}

