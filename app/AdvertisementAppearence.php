<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementAppearence extends Model
{
   protected $table    = "advertisement_appearences";
   protected $fillable = ['title','status'];
}
