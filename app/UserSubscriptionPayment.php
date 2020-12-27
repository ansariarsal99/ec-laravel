<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptionPayment extends Model
{

     protected $table    = 'user_subscriptions_payments';
     protected $fillable   = ['user_id','invoice_image','status','card_type','card_no','name_on_card','expiry_month','expiry_year','cvv','use_card_as_default','payment_type','transaction_id'];
    
}
