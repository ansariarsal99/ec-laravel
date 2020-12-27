<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildMartFeesAndCondtion extends Model
{
    protected $table    ="build_mart_fees_and_condtions";	
    protected $fillable =['admin_id','fees_type','percentage'];
}
