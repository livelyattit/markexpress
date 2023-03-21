<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{

    const SHIPMENT_CREATED = 1;
    const SHIPMENT_PICKED = 2;
    const DELIVERY_IN_PROCESS = 3;
    const DELIVERED_PAYMENT_IN_PROCESS = 4;
    const DELIVERED = 5;
    const UNDELIVERED = 6;
    const REATTEMPT = 7;
    const RETURN_IN_PROCESS = 8;
    const RETURNED = 9;

    protected $fillable = [
        'user_id',
        'addresslog_id',
        'assigned_parcel_number',
        'city_id',
        'consignee_name',
        'consignee_contact',
        'consignee_address',
        'consignee_nearby_address',
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

//   public function addressLog(){
//       return $this->belongsTo(Addresslog::class, 'addresslog_id', 'id');
//   }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
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
