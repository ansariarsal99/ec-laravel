<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSelectedSellingMaterial extends Model
{
    protected $table = 'product_selected_selling_materials';

    protected $fillable = ['user_id','product_id','product_selling_material_id'];

    public function productSellingMaterialDetail(){
        return $this->hasOne('App\productSellingMaterial','id','product_selling_material_id');
    }
}
