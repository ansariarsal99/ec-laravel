<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
     protected $table    = 'reward_points';
     protected $fillable = ['reward_type','from_amount','to_amount','point','category_id','product_name'];

     public function productName(){
      	return $this->hasOne('App\Product','id','product_name');
     }

}
