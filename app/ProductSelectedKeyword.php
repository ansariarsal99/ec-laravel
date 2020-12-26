<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSelectedKeyword extends Model
{
    protected $table = 'product_selected_keywords';

    protected $fillable = ['product_id','user_id','product_keyword_id'];

    public function productKeywordDetail(){
        return $this->hasOne('App\ProductKeyword','id','product_keyword_id');
    }
}
