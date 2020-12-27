<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardPointPrice extends Model
{
    protected $table    = 'reward_points_prices';
    protected $fillable = ['point_price','point'];
}

