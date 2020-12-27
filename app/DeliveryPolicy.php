<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryPolicy extends Model
{
     protected $table = "delivery_policies";
     protected $fillable = ['title','description'];
}
