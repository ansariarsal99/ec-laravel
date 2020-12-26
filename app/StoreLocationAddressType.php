<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreLocationAddressType extends Model
{
    //
    protected $table = "store_location_address_types";

    protected $fillable = ['name','status'];
}
