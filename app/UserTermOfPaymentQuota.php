<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTermOfPaymentQuota extends Model
{
     protected $table = 'user_term_of_payments_quotas';
     protected $fillable = ['user_term_of_payments_id','quota_percent','title','user_id'];
}
 	