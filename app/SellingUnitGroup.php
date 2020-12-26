<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingUnitGroup extends Model
{
    protected $table = 'selling_unit_groups';
    protected $fillable = ['name','status'];

    public function productSellingUnits() {

       	return $this->hasMany('App\ProductSellingUnit', 'selling_unit_group_id', 'id')->where('status','active');
   	}
}
