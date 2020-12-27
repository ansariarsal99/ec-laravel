<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfessionImage extends Model
{
	protected $table    = "user_profession_images";
    protected $fillable = ['user_id','name','status'];
}
