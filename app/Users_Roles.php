<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Roles extends Model
{
    protected $table = 'users_roles';
    protected $fillable = ['role'];
}
