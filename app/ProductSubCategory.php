<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $table = 'product_sub_categories';

    protected $fillable = ['category_id','name','status'];

    public function category()
    {
    	return $this->hasOne('App\ProductCategory', 'id', 'category_id');
    }
}
