<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     protected $table = 'cities';
    protected $fillable = ['name','name_arabic','state_id','country_id','status'];
}
