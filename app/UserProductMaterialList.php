<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProductMaterialList extends Model
{
   
    protected $table 		= "user_product_selected_materials";
    protected $fillable 	= ['user_id','material_id'];
   
}
