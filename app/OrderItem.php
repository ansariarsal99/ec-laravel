<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
     protected $fillable = ['order_id','seller_id','sub_order_id','product_id','product_store_id','product_name','quantity','quantity_price','item_price','status','store_pick_up_id','address_type','user_delivery_address_id','product_unit','cancellationReason','seller_cancellation_reason','product_order_status_id','product_order_refund_id','refund_order_approved_by_admin','admin_approved_product_order_refund_id','admin_commission','pay_admin_commission','admin_commission_date'];

    public function productName(){
    	return $this->hasOne('App\Product','id','product_id');
    }

    public function delivery_address(){
    	return $this->hasOne('App\UserDeliveryAddress','id','user_delivery_address_id');
    }
    
    public function Order(){
    	return $this->hasOne('App\Order','id','order_id');
    }

    public function storeAddress(){
        return $this->hasOne('App\UserStoreLocation','id','product_store_id');
    }

    public function productOrderStatus(){
        return $this->hasOne('App\ProductOrderStatus','id','product_order_status_id');
    }

    public function productRefundOrderStatus(){
        return $this->hasOne('App\productOrderRefund','id','product_order_refund_id');
    }

    public function productApprovedRefundOrderStatusbyAdmin(){
        return $this->hasOne('App\productOrderRefund','id','admin_approved_product_order_refund_id');
    }
    

}
