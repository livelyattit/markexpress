<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresslog extends Model
{
    protected $fillable = [
        'user_id',
        'city_id',
        'consignee_alias',
        'consignee_name',
        'consignee_contact',
        'consignee_address',
        'consignee_nearby_address',
        ];

    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id' );
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
