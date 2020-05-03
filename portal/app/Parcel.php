<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
   public function status(){
       return $this->belongsToMany(Status::class, 'parcel_status', 'parcel_id', 'status_id');
   }
}
