<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    protected $fillable = ['user_id', 'product_id', 'name', 'status'];
}
