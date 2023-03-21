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
        $statuses = [
            'shipment created',
            'shipment picked',
            'delivery in process',
            'delivered payment in process',
            'delivered',
            'undelivered',
            'reattempt',
            'return in process',
            'returned',
        ];

        foreach ($statuses as $status){
            Status::create([
                'status'=>$status
            ]);
        }
    }
}
