<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountdetail extends Model
{
    protected $fillable = [
      'user_id',
      'business_name',
      'shipment_quantity',
      'bank_name',
      'bank_account_title',
      'bank_account_number',
    ];
}
