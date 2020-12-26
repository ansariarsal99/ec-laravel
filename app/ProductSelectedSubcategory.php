<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSelectedSubcategory extends Model
{
    protected $table = 'product_selected_subcategories';

    protected $fillable = ['user_id','product_id','subcategory_id'];

    public function productSubCategoryDetail(){
        return $this->hasOne('App\ProductSubCategory','id','subcategory_id');
    }
}
