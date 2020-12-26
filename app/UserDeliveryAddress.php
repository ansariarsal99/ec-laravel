<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDeliveryAddress extends Model
{
    protected $fillable = ['user_id','address_title','address','province_name','postal_code','location','latitude','longitude','city','city_id','country_id','use_address_as_default','status'];

    public function countryDetail() {
        return $this->belongsTo('App\Country','country_id','id');
    }

    public function cityDetail() {
        return $this->belongsTo('App\City','city_id','id');
    }
}
