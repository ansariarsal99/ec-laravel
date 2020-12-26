<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{   
   protected $table    = 'user_subscriptions';
   protected $fillable = ['user_id','subscription_id','title','description','price','time_limit','time_type','status','expiry_subscription_package'];
}