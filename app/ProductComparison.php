<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComparison extends Model
{
	protected $table = 'product_comparisons';

    protected $fillable = ['user_id','product_id'];

    public function product()
    {
    	return $this->hasOne('App\Product', 'id', 'product_id');
    }
    
}
