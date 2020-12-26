<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTax extends Model
{
	protected $table = 'product_taxes';
	protected $fillable = ['tax_percent'];
    
}
