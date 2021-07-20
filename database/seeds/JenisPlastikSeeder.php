<?php

use Illuminate\Database\Seeder;
use App\models\JenisPlastik;

class JenisPlastikSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
        \DB::table('jenis_plastiks')->delete();
        
        \DB::table('jenis_plastiks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_plastik' => 'PET/PP CUP',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:49:49',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'nama_plastik' => 'RIGID/KERASAN',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:50:15',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'nama_plastik' => 'FILM/DAUNAN',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:50:09',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'nama_plastik' => 'MULTILAYER LABEL',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:50:04',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'nama_plastik' => 'MULTILAYER NON METALLIZED',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:49:57',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'nama_plastik' => 'MULTILAYER METALLIZED',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:48:11',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 4,
            ),
            6 => 
            array (
                'id' => 7,
                'nama_plastik' => 'Produk Hasil Olahan',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-24 17:16:02',
                'deleted_at' => NULL,
                'kategori_plastik_id' => 5,
            ),
        ));
        
	}
}
