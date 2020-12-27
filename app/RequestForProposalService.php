<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForProposalService extends Model
{
    protected $table = "request_for_proposal_services";

    protected $fillable = ['request_for_proposal_id','user_service_id','status'];

    public function userServiceDetail() {

    	return $this->hasOne('App\UserService','id','user_service_id');
    }
}
