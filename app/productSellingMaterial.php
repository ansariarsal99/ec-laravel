<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productSellingMaterial extends Model
{
    protected $table	 = 'product_selling_materials';

    protected $fillable  = ['selling_material_name','product_category_id','product_sub_category_id','status'];

    public function selectedCategory(){
        return $this->hasOne('App\ProductCategory','id','product_category_id');
    }

    public function selectedSubCategory(){
        return $this->hasOne('App\ProductSubCategory','id','product_sub_category_id');
    }
}
	 