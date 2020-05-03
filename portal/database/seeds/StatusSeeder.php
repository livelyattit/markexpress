<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['initiated', 'on way', 'delivered', 'canceled', 'returned'];

        foreach ($statuses as $status){
            Status::create([
                'status'=>$status
            ]);
        }
    }
}
