<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDeliveryAddress extends Model
{
    protected $table    = 'order_delivery_address';
    protected $fillable = ['order_id','title','store_name','address','province_name','country_id','state_id','city_id','location','latitude','longitude','postal_code'];
}
