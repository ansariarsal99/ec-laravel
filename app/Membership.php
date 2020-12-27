<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'memberships';
    protected $fillable = ['title','description','status'];
    
    public function membership(){
     	return $this->hasMany('App\MembershipLevel','membership_id','id');
    }
}
