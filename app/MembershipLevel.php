<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipLevel extends Model
{
    protected $table = 'memberships_levels';
    protected $fillable = ['membership_id','title','description','point_from','point_to','status'];
}
