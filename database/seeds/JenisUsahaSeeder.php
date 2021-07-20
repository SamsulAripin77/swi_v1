<?php

use Illuminate\Database\Seeder;
use App\models\JenisUsaha;

class JenisUsahaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('jenis_usahas')->delete();
        
        \DB::table('jenis_usahas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_usaha' => 'Pabrikan',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-04 01:45:00',
                'deleted_at' => NULL,
                'kode' => 'PB',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_usaha' => 'Pembuat Pelet',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-04 01:44:40',
                'deleted_at' => NULL,
                'kode' => 'PP',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_usaha' => 'Penggiling',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-04 01:44:28',
                'deleted_at' => NULL,
                'kode' => 'PG',
            ),
            3 => 
            array (
                'id' => 4,
                'nama_usaha' => 'Lapak',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-04 01:44:14',
                'deleted_at' => NULL,
                'kode' => 'LP',
            ),
            4 => 
            array (
                'id' => 5,
                'nama_usaha' => 'Pengumpul',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-04 01:40:06',
                'deleted_at' => NULL,
                'kode' => 'PE',
            ),
            5 => 
            array (
                'id' => 6,
                'nama_usaha' => 'Pemulung',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-04 01:43:47',
                'deleted_at' => NULL,
                'kode' => 'PM',
            ),
        ));
        
	}
}
