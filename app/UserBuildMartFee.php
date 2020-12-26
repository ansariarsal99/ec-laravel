<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBuildMartFee extends Model
{
    protected $table = 'user_build_mart_fees';

    protected $fillable = ['user_id','from_price','to_price','value','type','status','part'];
}
