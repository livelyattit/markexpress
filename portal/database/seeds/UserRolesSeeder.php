<?php

use App\Users_Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  DB::table('users_roles')->truncate();

        $users_roles = ['admin', 'delivery-boy', 'customer']; //donot change the sequence
        foreach($users_roles as $role){
            Users_Roles::create(['role'=>$role]);
        }
    }
}
