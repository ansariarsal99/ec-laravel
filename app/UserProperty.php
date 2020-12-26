<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProperty extends Model
{
    protected $table = 'user_properties';
    protected $fillable = ['user_type_id','name','status'];
}

	