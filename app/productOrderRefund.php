<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productOrderRefund extends Model
{
    protected $table 	= 'product_order_refunds';
    protected $fillable = ['name','alias','comment'];
}
