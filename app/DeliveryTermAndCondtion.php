<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryTermAndCondtion extends Model
{
    protected $table    ="delivery_term_and_condtions";	
    protected $fillable =['user_id','from_price_range','to_price_range','delivery_price','price_type'];
}
