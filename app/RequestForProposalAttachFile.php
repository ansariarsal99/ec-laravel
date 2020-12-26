<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForProposalAttachFile extends Model
{
    protected $table = 'request_for_proposal_attach_files';

    protected $fillable = ['request_for_proposal_id','name'];
}
