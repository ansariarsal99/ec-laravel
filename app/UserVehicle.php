<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    //
    protected $fillable = ['user_id','vehicle_number','vehicle_name','vehicle_registration_number','vehicle_chassis_number','image'];
}
