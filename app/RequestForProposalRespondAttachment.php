<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForProposalRespondAttachment extends Model
{
    //
    protected $table = "request_for_proposal_respond_attachments";

    protected $fillable = ['user_id','request_for_proposal_id','request_for_proposal_assign_to_user_id','document_name','attachment','status'];

    public function userDetail() {

        return $this->hasOne('App\User','id','user_id');
    }
}
