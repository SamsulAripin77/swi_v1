<?php

use Illuminate\Database\Seeder;

class BuyerUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('buyer_user')->delete();
        
        \DB::table('buyer_user')->insert(array (
            0 => 
            array (
                'buyer_id' => 1,
                'user_id' => 3,
            ),
            1 => 
            array (
                'buyer_id' => 2,
                'user_id' => 4,
            ),
            2 => 
            array (
                'buyer_id' => 3,
                'user_id' => 4,
            ),
            3 => 
            array (
                'buyer_id' => 4,
                'user_id' => 5,
            ),
            4 => 
            array (
                'buyer_id' => 5,
                'user_id' => 6,
            ),
            5 => 
            array (
                'buyer_id' => 10,
                'user_id' => 8,
            ),
            6 => 
            array (
                'buyer_id' => 9,
                'user_id' => 8,
            ),
            7 => 
            array (
                'buyer_id' => 8,
                'user_id' => 7,
            ),
            8 => 
            array (
                'buyer_id' => 7,
                'user_id' => 7,
            ),
            9 => 
            array (
                'buyer_id' => 6,
                'user_id' => 7,
            ),
        ));
    }
}
