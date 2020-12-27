<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTermOfPayment extends Model
{
     protected $table = 'user_term_of_payments';
     protected $fillable = ['user_id','name','number_of_quota','use_term_of_payment_as_default'];

       public function userTermOfPaymentQuotas(){
     	return $this->hasMany('App\UserTermOfPaymentQuota','user_term_of_payments_id','id');
     }
}
 	 	 