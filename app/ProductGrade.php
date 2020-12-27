<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGrade extends Model
{
     protected $table = 'product_grades';

     protected $fillable = ['grade_name'];
}
