<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    protected $table = 'user_services';
    protected $fillable = ['user_type_id','name','status'];
}
