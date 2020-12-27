<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductKeyword extends Model
{
    protected $table = 'product_keywords';

    protected $fillable = ['product_id','user_id','keyword_name'];
}
