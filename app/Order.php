<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['invoice_id','user_id','tax_price','coupon_name','coupon_type','discount_price','discount_percent','sub_total','final_total','placed_on','deliver_on','order_status'];

    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }
    public function orderItems(){
    	return $this->hasMany('App\OrderItem','order_id','id');
    }
}
