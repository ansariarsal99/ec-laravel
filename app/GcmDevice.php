<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GcmDevice extends Model
{
    //
    protected $table = "gcm_devices";
    
    protected $fillable = ['user_id','device_id','device_token','device_type'];
}
