<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOtherService extends Model
{
    protected $table    = 'user_other_services';
    protected $fillable = ['user_id','user_type_id','name','status'];

}
