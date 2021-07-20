<?php

use Illuminate\Database\Seeder;

class JenisUsahaUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_usaha_user')->delete();
        
        \DB::table('jenis_usaha_user')->insert(array (
            0 => 
            array (
                'jenis_usaha_id' => 1,
                'user_id' => 2,
            ),
            1 => 
            array (
                'jenis_usaha_id' => 2,
                'user_id' => 2,
            ),
            2 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 2,
            ),
            3 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 2,
            ),
            4 => 
            array (
                'jenis_usaha_id' => 1,
                'user_id' => 1,
            ),
            5 => 
            array (
                'jenis_usaha_id' => 2,
                'user_id' => 1,
            ),
            6 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 1,
            ),
            7 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 1,
            ),
            8 => 
            array (
                'jenis_usaha_id' => 1,
                'user_id' => 3,
            ),
            9 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 6,
            ),
            10 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 7,
            ),
            11 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 9,
            ),
            12 => 
            array (
                'jenis_usaha_id' => 1,
                'user_id' => 10,
            ),
            13 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 4,
            ),
            14 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 5,
            ),
            15 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 6,
            ),
            16 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 7,
            ),
            17 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 8,
            ),
            18 => 
            array (
                'jenis_usaha_id' => 1,
                'user_id' => 4,
            ),
            19 => 
            array (
                'jenis_usaha_id' => 2,
                'user_id' => 11,
            ),
            20 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 11,
            ),
            21 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 11,
            ),
            22 => 
            array (
                'jenis_usaha_id' => 5,
                'user_id' => 11,
            ),
            23 => 
            array (
                'jenis_usaha_id' => 6,
                'user_id' => 11,
            ),
            24 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 3,
            ),
            25 => 
            array (
                'jenis_usaha_id' => 2,
                'user_id' => 12,
            ),
            26 => 
            array (
                'jenis_usaha_id' => 3,
                'user_id' => 12,
            ),
            27 => 
            array (
                'jenis_usaha_id' => 4,
                'user_id' => 12,
            ),
            28 => 
            array (
                'jenis_usaha_id' => 5,
                'user_id' => 12,
            ),
            29 => 
            array (
                'jenis_usaha_id' => 6,
                'user_id' => 12,
            ),
            31 => 
            array (
                'jenis_usaha_id' => 5,
                'user_id' => 2,
            ),
            32 => 
            array (
                'jenis_usaha_id' => 6,
                'user_id' => 2,
            ),
        ));
        
        
    }
}
