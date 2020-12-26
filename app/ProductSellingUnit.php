<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSellingUnit extends Model
{
       protected $table = 'product_selling_units';

       protected $fillable = ['name','status'];

       // public function sellingUnitGroup()
       // {
       //     return $this->hasOne('App\SellingUnitGroup', 'id', 'selling_unit_group_id');
       // }
}
