<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
	protected $table='admins';
    protected $fillable = ['type','first_name','mawad_mart_code','last_name','email','phone_no','image','password','remember_token','status','mawad_mart_code','is_login'];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
