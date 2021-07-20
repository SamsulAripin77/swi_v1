<?php

use Illuminate\Database\Seeder;

class SupplierUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('supplier_user')->delete();
        
        \DB::table('supplier_user')->insert(array (
            0 => 
            array (
                'supplier_id' => 1,
                'user_id' => 3,
            ),
            1 => 
            array (
                'supplier_id' => 2,
                'user_id' => 3,
            ),
            2 => 
            array (
                'supplier_id' => 3,
                'user_id' => 3,
            ),
            3 => 
            array (
                'supplier_id' => 4,
                'user_id' => 4,
            ),
            4 => 
            array (
                'supplier_id' => 5,
                'user_id' => 4,
            ),
            5 => 
            array (
                'supplier_id' => 6,
                'user_id' => 4,
            ),
            6 => 
            array (
                'supplier_id' => 7,
                'user_id' => 5,
            ),
            7 => 
            array (
                'supplier_id' => 8,
                'user_id' => 5,
            ),
            8 => 
            array (
                'supplier_id' => 9,
                'user_id' => 5,
            ),
            9 => 
            array (
                'supplier_id' => 10,
                'user_id' => 6,
            ),
            10 => 
            array (
                'supplier_id' => 11,
                'user_id' => 6,
            ),
            11 => 
            array (
                'supplier_id' => 12,
                'user_id' => 7,
            ),
            12 => 
            array (
                'supplier_id' => 13,
                'user_id' => 7,
            ),
            13 => 
            array (
                'supplier_id' => 14,
                'user_id' => 7,
            ),
            14 => 
            array (
                'supplier_id' => 15,
                'user_id' => 8,
            ),
            15 => 
            array (
                'supplier_id' => 16,
                'user_id' => 8,
            ),
            16 => 
            array (
                'supplier_id' => 17,
                'user_id' => 8,
            ),
            17 => 
            array (
                'supplier_id' => 18,
                'user_id' => 1,
            ),
            18 => 
            array (
                'supplier_id' => 19,
                'user_id' => 11,
            ),
        ));
    }
}
