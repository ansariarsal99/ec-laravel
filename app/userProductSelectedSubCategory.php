<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProductSelectedSubCategory extends Model
{
   	   protected $table = "user_product_selected_sub_categories";

       protected $fillable = ['user_id','sub_category_id'];
}
