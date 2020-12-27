<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWishlist extends Model
{
    protected $table = 'product_wishlists';

    protected $fillable = ['user_id','product_id'];

    public function product()
    {
    	return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
