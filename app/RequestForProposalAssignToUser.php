<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForProposalAssignToUser extends Model
{
    protected $table = "request_for_proposal_assign_to_users";

    protected $fillable = ['request_for_proposal_id','user_id','project_request_no','request_for_proposal_assign_to_user_status_id','user_status','provider_status','quotation_price','status'];

    public function requestForProposalDetail() {

    	return $this->hasOne('App\RequestForProposal','id','request_for_proposal_id');
    }

    public function userDetail() {

    	return $this->hasOne('App\User','id','user_id');
    }

    public function defaultTermOfPayment() {

    	return $this->hasOne('App\UserTermOfPayment','user_id','user_id');
    }

    public function requestForProposalAssignToUserStatusDetail() {

        return $this->hasOne('App\RequestForProposalAssignToUserStatus','id','request_for_proposal_assign_to_user_status_id');
    }

}
