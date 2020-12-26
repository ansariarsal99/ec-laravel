<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAdvertisement extends Model
{
   protected $table    = "user_advertisements";
   protected $fillable = ['user_id','title','advertisement_appearence_id','payment_method','image','publish_date','expiry_date'];
   
   public function advertisementAppearence()
   {
    	return $this->belongsTo('App\AdvertisementAppearence', 'advertisement_appearence_id','id');
   }
   
}
