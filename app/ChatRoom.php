<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $table = "chat_rooms";

    protected $fillable = ['room_id','sender_id','receiver_id','user_id','admin_id','type','last_message','last_message_time','status'];

    public function senderDetail() {

    	return $this->hasOne('App\User','id','sender_id');
    }

    public function receiverDetail() {

    	return $this->hasOne('App\User','id','receiver_id');
    }

    public function userDetail() {

    	return $this->hasOne('App\User','id','user_id');
    }

    public function adminDetail() {

    	return $this->hasOne('App\Admin','id','admin_id');
    }
}
