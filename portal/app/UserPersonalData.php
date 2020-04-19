<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPersonalData extends Model
{
    const BILL_REQUEST_CONFIRMATION = 0;
    const CNIC_REQUEST_CONFIRMATION = 0;

    protected $fillable = [
        'user_id',
         'bill_file_name',
          'cnic_file_name',
           'bill_request_confirmation',
            'cnic_request_confirmation'
        ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function($query){
            $query->bill_request_confirmation = $query->bill_request_confirmation ?? self::BILL_REQUEST_CONFIRMATION;
            $query->cnic_request_confirmation = $query->cnic_request_confirmation ?? self::CNIC_REQUEST_CONFIRMATION;

        });
    }

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
}
