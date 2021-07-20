<?php

use App\Models\KategoriPlastik;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('kategori_plastiks')->delete();
        
        \DB::table('kategori_plastiks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'jenis_plastik' => 'PET',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-04-21 08:47:52',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'jenis_plastik' => 'RIGID',
                'keterangan' => NULL,
                'created_at' => '2021-04-21 08:47:27',
                'updated_at' => '2021-04-21 08:47:27',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'jenis_plastik' => 'FILM',
                'keterangan' => NULL,
                'created_at' => '2021-04-21 08:47:37',
                'updated_at' => '2021-04-21 08:47:37',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'jenis_plastik' => 'MULTILAYER',
                'keterangan' => NULL,
                'created_at' => '2021-04-21 08:47:46',
                'updated_at' => '2021-04-21 08:47:46',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'jenis_plastik' => 'Produk Hasil Olahan',
                'keterangan' => NULL,
                'created_at' => '2021-05-24 17:15:48',
                'updated_at' => '2021-05-24 17:15:48',
                'deleted_at' => NULL,
            ),
        ));
    }
}
