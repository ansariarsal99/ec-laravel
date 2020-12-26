<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderCity extends Model
{
    //
    protected $table = 'provider_cities';
    protected $fillable = ['city_id','status'];

    public function cityDetail() {
        return $this->hasOne('App\City','id','city_id');
    }
}
