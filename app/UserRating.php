<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
 	protected $table = 'user_ratings';
    protected $fillable = ['user_id','product_id','rating','review'];
    
    public function user_name(){
      	return $this->hasOne('App\User','id','user_id');
    }
}
