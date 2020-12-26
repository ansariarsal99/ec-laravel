<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentCard extends Model
{
    protected $fillable = ['user_id','card_type','card_no','name_on_card','expiry_month','expiry_year','cvv','use_card_as_default','status'];
}
