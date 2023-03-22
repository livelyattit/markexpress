<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends User
{

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        $customer_role = Role::query()->where('name', 'customer')->firstOrFail();

        static::addGlobalScope(function ($query) use ($customer_role) {
            $query->where('role_id', '=', $customer_role->id ); //2 is for customer
        });
    }


}
