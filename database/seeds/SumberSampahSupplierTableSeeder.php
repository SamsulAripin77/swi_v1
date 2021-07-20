<?php

use Illuminate\Database\Seeder;

class SumberSampahSupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('sumber_sampah_supplier')->delete();
        
        \DB::table('sumber_sampah_supplier')->insert(array (
            0 => 
            array (
                'supplier_id' => 2,
                'sumber_sampah_id' => 3,
            ),
            1 => 
            array (
                'supplier_id' => 1,
                'sumber_sampah_id' => 4,
            ),
            2 => 
            array (
                'supplier_id' => 3,
                'sumber_sampah_id' => 3,
            ),
            3 => 
            array (
                'supplier_id' => 4,
                'sumber_sampah_id' => 5,
            ),
            4 => 
            array (
                'supplier_id' => 5,
                'sumber_sampah_id' => 5,
            ),
            5 => 
            array (
                'supplier_id' => 6,
                'sumber_sampah_id' => 5,
            ),
            6 => 
            array (
                'supplier_id' => 7,
                'sumber_sampah_id' => 5,
            ),
            7 => 
            array (
                'supplier_id' => 8,
                'sumber_sampah_id' => 5,
            ),
            8 => 
            array (
                'supplier_id' => 9,
                'sumber_sampah_id' => 5,
            ),
            9 => 
            array (
                'supplier_id' => 10,
                'sumber_sampah_id' => 5,
            ),
            10 => 
            array (
                'supplier_id' => 11,
                'sumber_sampah_id' => 5,
            ),
            11 => 
            array (
                'supplier_id' => 12,
                'sumber_sampah_id' => 5,
            ),
            12 => 
            array (
                'supplier_id' => 13,
                'sumber_sampah_id' => 5,
            ),
            13 => 
            array (
                'supplier_id' => 14,
                'sumber_sampah_id' => 5,
            ),
            14 => 
            array (
                'supplier_id' => 15,
                'sumber_sampah_id' => 5,
            ),
            15 => 
            array (
                'supplier_id' => 16,
                'sumber_sampah_id' => 4,
            ),
            16 => 
            array (
                'supplier_id' => 17,
                'sumber_sampah_id' => 5,
            ),
            17 => 
            array (
                'supplier_id' => 17,
                'sumber_sampah_id' => 4,
            ),
            19 => 
            array (
                'supplier_id' => 18,
                'sumber_sampah_id' => 1,
            ),
            20 => 
            array (
                'supplier_id' => 18,
                'sumber_sampah_id' => 2,
            ),
            21 => 
            array (
                'supplier_id' => 18,
                'sumber_sampah_id' => 3,
            ),
            22 => 
            array (
                'supplier_id' => 18,
                'sumber_sampah_id' => 4,
            ),
            23 => 
            array (
                'supplier_id' => 18,
                'sumber_sampah_id' => 5,
            ),
            25 => 
            array (
                'supplier_id' => 19,
                'sumber_sampah_id' => 1,
            ),
            26 => 
            array (
                'supplier_id' => 19,
                'sumber_sampah_id' => 2,
            ),
            27 => 
            array (
                'supplier_id' => 19,
                'sumber_sampah_id' => 3,
            ),
            28 => 
            array (
                'supplier_id' => 19,
                'sumber_sampah_id' => 4,
            ),
            29 => 
            array (
                'supplier_id' => 19,
                'sumber_sampah_id' => 5,
            ),
           
        ));
    }
}
