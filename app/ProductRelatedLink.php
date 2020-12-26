<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelatedLink extends Model
{
    protected $table = 'product_related_links';

    protected $fillable = ['product_id','user_id','link'];
}
