<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = "notifications";

    protected $fillable = ['sender_id','receiver_id','content_id','message','type'];

    public function senderDetail() {
    	return $this->hasOne('App\User','id','sender_id');
    }

    public function receiverDetail() {
    	return $this->hasOne('App\User','id','receiver_id');
    }

    public function requestForProposalDetail() {
    	return $this->hasOne('App\RequestForProposal','id','content_id');
    }
}
