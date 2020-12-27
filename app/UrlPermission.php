<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlPermission extends Model
{
    //
    protected $table = "url_permissions";

    protected $fillable = ['name', 'role_id', 'urls'];

    public function role() {
        return $this->belongsTo('\Spatie\Permission\Models\Role','role_id');
    }

}
