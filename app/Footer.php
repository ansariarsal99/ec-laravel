<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
   protected $table = 'footers';
   protected $fillable = ['contact_number','email','address','isd_code'];

}

 
