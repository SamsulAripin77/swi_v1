<?php

use Illuminate\Database\Seeder;
use App\Models\SumberSampah;

class SumberSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sumber_sampahs')->delete();
        
        \DB::table('sumber_sampahs')->insert(array (
            1 => 
            array (
                'id' => 1,
                'sumber_sampah' => 'TPA',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 2,
                'sumber_sampah' => 'TPS',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 3,
                'sumber_sampah' => 'Jalan',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 4,
                'sumber_sampah' => 'Perumahan',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 5,
                'sumber_sampah' => 'Perkantoran/Komersil',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'sumber_sampah' => 'coba deh',
                'keterangan' => NULL,
                'created_at' => '2021-05-28 10:04:26',
                'updated_at' => '2021-05-28 10:04:26',
                'deleted_at' => NULL,
            ),
			7 => 
            array (
                'id' => 8,
                'sumber_sampah' => '',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-28 06:39:06',
                'deleted_at' => '2021-05-28 06:39:06',
            ),
        ));
        
        
    }
}
