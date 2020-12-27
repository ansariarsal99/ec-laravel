<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSelectedProjectField extends Model
{
    //
    protected $table = "user_selected_project_fields";

    protected $fillable = ['user_id','user_project_field_id'];

    public function userProjectFieldDetail() {

        return $this->hasOne('App\UserProjectField','id','user_project_field_id');
    }
}
