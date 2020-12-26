<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSelectedService extends Model
{
    protected $table = 'user_selected_services';
    protected $fillable = ['user_id','user_service_id'];

    public function userServiceDetail() {

        return $this->hasOne('App\UserService','id','user_service_id');
    }
}
