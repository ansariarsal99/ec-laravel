<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForProposalUserCheckProvider extends Model
{
    protected $fillable = ['user_id','provider_id','user_type_id'];
}
