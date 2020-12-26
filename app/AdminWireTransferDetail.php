<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminWireTransferDetail extends Model
{
   protected $table='admin_wire_transfer_details';
   protected $fillable = ['admin_id','bank_name','account_name','account_iban_number','status'];

}
