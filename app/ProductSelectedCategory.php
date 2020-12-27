<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSelectedCategory extends Model
{
    protected $table = 'product_selected_categories';

    protected $fillable = ['user_id','product_id','category_id'];

    public function productCategoryDetail(){
        return $this->hasOne('App\ProductCategory','id','category_id');
    }
}
