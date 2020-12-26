<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountedProduct extends Model
{
    protected $table = 'discounted_products';
    protected $fillable = ['seller_discount_code_id','user_id','product_id'];
   
   public function product(){
     return $this->hasOne('App\Product','id','product_id');
   }  

   public function discountedProducts(){
     return $this->hasOne('App\SellerDiscountCode','id','seller_discount_code_id');
   }

    public function sellerDiscountCode(){
     return $this->hasOne('App\SellerDiscountCode','id','seller_discount_code_id');
   }

}
