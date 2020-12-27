<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductNewOption extends Model
{
    protected $table = 'product_new_options';

    protected $fillable = ['product_id','title','value','option_type','product_selling_unit_id','status'];

    public function productSellingUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','product_selling_unit_id');
    }
}
