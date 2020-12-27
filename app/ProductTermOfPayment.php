<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTermOfPayment extends Model
{

	protected $table = 'product_terms_of_payment';

    protected $fillable = ['user_id','product_id','from_price','to_price','range_type','selected_plan_id','part'];
    
     public function planName()
    {
        return $this->hasOne('App\UserTermOfPayment', 'id', 'selected_plan_id');
    }

    public function planDetail() {
        return $this->hasOne('App\UserTermOfPayment', 'id', 'selected_plan_id');
    }
}
