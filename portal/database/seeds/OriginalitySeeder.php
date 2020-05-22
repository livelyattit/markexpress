<?php

use App\Originality;
use Illuminate\Database\Seeder;

class OriginalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $originality =[
            '0'=>'user created',
            '1'=>'file verification',
            '2'=>'business verification',
            '3'=>'verified',
        ];
        foreach($originality as $originality_verified=>$status){
            Originality::create(
                [
                'originality_verified' => $originality_verified,
                'status'=> $status,
                ]);
        }
    }
}
