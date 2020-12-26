<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
   protected $table    = 'subscriptions';
   protected $fillable = ['title','description','price','time_limit','time_type','status'];
}
