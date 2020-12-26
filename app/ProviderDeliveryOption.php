<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderDeliveryOption extends Model
{
    protected $table = 'provider_delivery_options';
    protected $fillable = ['delivery_type'];
}
