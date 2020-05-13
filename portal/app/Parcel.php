<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $fillable = [
        'user_id',
        'addresslog_id',
        'assigned_parcel_number',
        'weight',
        'length',
        'width',
        'height',
        'assigned_tracking_number',
        'amount',
    ];

   public function status(){
       return $this->belongsToMany(Status::class, 'parcel_status', 'parcel_id', 'status_id');
   }

   public static function generateParcelNumber(){
       $generated_parcel_num = 1000;
       $parcel = self::latest()->first();
       if($parcel){
          $generated_parcel_num = (int)  $parcel->assigned_parcel_number;
          $generated_parcel_num++;
       }

       return $generated_parcel_num;
   }

}
