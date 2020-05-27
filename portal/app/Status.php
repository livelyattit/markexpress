<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status'];

    public function parcel(){
        return $this->belongsToMany(Parcel::class, 'parcel_status', 'status_id', 'parcel_id')->withTimestamps();
    }
}
