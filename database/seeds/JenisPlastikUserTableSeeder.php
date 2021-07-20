<?php

use Illuminate\Database\Seeder;

class JenisPlastikUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jenis_plastik_user')->delete();
        
        \DB::table('jenis_plastik_user')->insert(array (
            0 => 
            array (
                'user_id' => 2,
                'jenis_plastik_id' => 2,
            ),
            1 => 
            array (
                'user_id' => 2,
                'jenis_plastik_id' => 5,
            ),
            2 => 
            array (
                'user_id' => 2,
                'jenis_plastik_id' => 6,
            ),
            3 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 3,
            ),
            4 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 4,
            ),
            5 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 3,
            ),
            6 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 4,
            ),
            7 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 5,
            ),
            8 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 6,
            ),
            9 => 
            array (
                'user_id' => 4,
                'jenis_plastik_id' => 3,
            ),
            10 => 
            array (
                'user_id' => 5,
                'jenis_plastik_id' => 1,
            ),
            11 => 
            array (
                'user_id' => 5,
                'jenis_plastik_id' => 2,
            ),
            12 => 
            array (
                'user_id' => 6,
                'jenis_plastik_id' => 1,
            ),
            13 => 
            array (
                'user_id' => 6,
                'jenis_plastik_id' => 2,
            ),
            14 => 
            array (
                'user_id' => 6,
                'jenis_plastik_id' => 4,
            ),
            15 => 
            array (
                'user_id' => 7,
                'jenis_plastik_id' => 1,
            ),
            16 => 
            array (
                'user_id' => 7,
                'jenis_plastik_id' => 2,
            ),
            17 => 
            array (
                'user_id' => 8,
                'jenis_plastik_id' => 1,
            ),
            18 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 7,
            ),
            19 => 
            array (
                'user_id' => 9,
                'jenis_plastik_id' => 1,
            ),
            20 => 
            array (
                'user_id' => 9,
                'jenis_plastik_id' => 2,
            ),
            21 => 
            array (
                'user_id' => 9,
                'jenis_plastik_id' => 3,
            ),
            22 => 
            array (
                'user_id' => 9,
                'jenis_plastik_id' => 5,
            ),
            23 => 
            array (
                'user_id' => 10,
                'jenis_plastik_id' => 2,
            ),
            24 => 
            array (
                'user_id' => 10,
                'jenis_plastik_id' => 5,
            ),
            25 => 
            array (
                'user_id' => 4,
                'jenis_plastik_id' => 7,
            ),
            26 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 1,
            ),
            27 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 2,
            ),
            28 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 5,
            ),
            29 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 6,
            ),
            30 => 
            array (
                'user_id' => 1,
                'jenis_plastik_id' => 7,
            ),
            31 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 1,
            ),
            32 => 
            array (
                'user_id' => 3,
                'jenis_plastik_id' => 2,
            ),
            33 => 
            array (
                'user_id' => 12,
                'jenis_plastik_id' => 1,
            ),
            34 => 
            array (
                'user_id' => 12,
                'jenis_plastik_id' => 2,
            ),
            35 => 
            array (
                'user_id' => 12,
                'jenis_plastik_id' => 3,
            ),
            36 => 
            array (
                'user_id' => 12,
                'jenis_plastik_id' => 4,
            ),
            37 => 
            array (
                'user_id' => 12,
                'jenis_plastik_id' => 5,
            ),
            38 => 
            array (
                'user_id' => 7,
                'jenis_plastik_id' => 4,
            ),
            39 => 
            array (
                'user_id' => 11,
                'jenis_plastik_id' => 1,
            ),
            40 => 
            array (
                'user_id' => 11,
                'jenis_plastik_id' => 2,
            ),
        ));
        
    }
}
