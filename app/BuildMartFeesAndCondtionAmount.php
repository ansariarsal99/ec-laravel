<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildMartFeesAndCondtionAmount extends Model
{
    protected $table    ="build_mart_fees_and_condtions_amounts";	
    protected $fillable =['admin_id','build_mart_fees_and_condtions_id','from_price_range','to_price_range','fees'];
}
