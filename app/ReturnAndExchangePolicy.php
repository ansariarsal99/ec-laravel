<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnAndExchangePolicy extends Model
{
     protected $table = "return_and_exchange_policies";
     protected $fillable = ['title','description'];
}
