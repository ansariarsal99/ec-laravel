<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInquery extends Model
{
   protected $table='user_inqueries';
   protected $fillable = ['user_id','seller_id','query','respond_status','created_at','response','inquery_id'];

   // public function user_name(){
   // return 	$this->hasOne('App\Seller','id','seller_id')->select('id','first_name','last_name');
   // }
}
