<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $table = 'product_specifications';

    protected $fillable = ['user_id','product_id','title', 'description', 'image', 'status'];
}
