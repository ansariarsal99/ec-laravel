<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrderStatus extends Model
{
        protected $table 	= 'product_order_statuses';
        protected $fillable = ['name','alias','comment'];
}
  