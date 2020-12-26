<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStoreLocation extends Model
{
     protected $table = 'user_store_locations';
     protected $fillable = ['user_id','title','address_type_id','store_name','street','country_id','state_id','city','city_id','location','latitude','longitude','use_address_as_default','status'];

    public function countryDetail() {
        return $this->belongsTo('App\Country','country_id','id');
    }

    public function stateDetail() {
        return $this->belongsTo('App\State','state_id','id');
    }

    public function cityDetail() {
        return $this->belongsTo('App\City','city_id','id');
    }

    public function storeLocationAddressTypeDetail() {
        return $this->belongsTo('App\StoreLocationAddressType','address_type_id','id');
    }
     public function products() {
        return $this->hasMany('App\Product','user_store_location_id','id');
    }
}
