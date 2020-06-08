<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $fillable = [
        'user_id',
        'addresslog_id',
        'assigned_parcel_number',
        'binded_addresslog',
        'current_last_status',
        'weight',
        'length',
        'width',
        'height',
        'assigned_tracking_number',
        'amount',
        't_basic_charges',
        't_booking_charges',
        't_cash_handling_charges',
        't_packing_charges',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status(){
       return $this->belongsToMany(Status::class, 'parcel_status', 'parcel_id', 'status_id')->withTimestamps();
   }

   public function currentStatus(){
       return $this->status()->orderBy('parcels.updated_at', 'desc')->first();
   }

   public function addressLog(){
       return $this->belongsTo(Addresslog::class, 'addresslog_id', 'id');
   }

   public function generateParcelNumber(){
       $generated_parcel_num = 1000;
       $parcel = self::max('assigned_parcel_number');
       if($parcel){
          $generated_parcel_num = (int)  $parcel;
          $generated_parcel_num++;
       }

       return $generated_parcel_num;
   }

}
