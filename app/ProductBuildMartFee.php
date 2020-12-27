<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBuildMartFee extends Model
{
    protected $table = 'product_build_mart_fees';

    protected $fillable = ['product_id','from_price','to_price','value','type','status','part'];
}
