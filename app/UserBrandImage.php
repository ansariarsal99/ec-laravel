<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBrandImage extends Model
{
	protected $table    = "user_brand_images";
    protected $fillable = ['user_id','name','status'];
}
