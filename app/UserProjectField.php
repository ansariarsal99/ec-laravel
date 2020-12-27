<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProjectField extends Model
{
    //
    protected $table = "user_project_fields";

    protected $fillable = ['user_type_id','name','status'];
}
