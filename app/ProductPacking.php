<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPacking extends Model
{
    protected $table = 'product_packings';
    protected $fillable = ['user_id','product_id','each_content_unit_id','content_number','content_unit_id'];

    public function eachContentUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','each_content_unit_id');
    }

    public function contentUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','content_unit_id');
    }
}
