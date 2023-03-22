<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['city_name', 'delivery_time', 'is_enabled', 'initial_weight_limit', 'initial_weight_price', 'additional_weight_price'];
}
