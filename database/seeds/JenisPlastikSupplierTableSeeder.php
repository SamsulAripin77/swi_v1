<?php

use Illuminate\Database\Seeder;

class JenisPlastikSupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jenis_plastik_supplier')->delete();
        
        \DB::table('jenis_plastik_supplier')->insert(array (
            0 => 
            array (
                'supplier_id' => 18,
                'jenis_plastik_id' => 1,
            ),
            1 => 
            array (
                'supplier_id' => 18,
                'jenis_plastik_id' => 2,
            ),
            2 => 
            array (
                'supplier_id' => 18,
                'jenis_plastik_id' => 3,
            ),
            3 => 
            array (
                'supplier_id' => 18,
                'jenis_plastik_id' => 4,
            ),
            4 => 
            array (
                'supplier_id' => 18,
                'jenis_plastik_id' => 5,
            ),
            5 => 
            array (
                'supplier_id' => 18,
                'jenis_plastik_id' => 6,
            ),
            6 => 
            array (
                'supplier_id' => 19,
                'jenis_plastik_id' => 1,
            ),
            7 => 
            array (
                'supplier_id' => 19,
                'jenis_plastik_id' => 2,
            ),
            8 => 
            array (
                'supplier_id' => 19,
                'jenis_plastik_id' => 3,
            ),
            9 => 
            array (
                'supplier_id' => 19,
                'jenis_plastik_id' => 4,
            ),
            10 => 
            array (
                'supplier_id' => 19,
                'jenis_plastik_id' => 5,
            ),
            11 => 
            array (
                'supplier_id' => 19,
                'jenis_plastik_id' => 6,
            )
        ));
    }
}
