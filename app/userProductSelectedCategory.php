<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProductSelectedCategory extends Model
{
      protected $table 		= "user_product_selected_categories";
      protected $fillable 	= ['user_id','category_id'];
}
 	

