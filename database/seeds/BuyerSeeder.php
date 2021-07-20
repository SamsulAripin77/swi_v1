<?php

use App\Models\Buyer;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('buyers')->delete();
        
        \DB::table('buyers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_buyer' => 'Ahmad',
                'no_telp' => '081298249900',
                'alamat' => 'Pabuaran Bogor,',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-23 16:20:00',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'nama_buyer' => 'Mahajaya',
                'no_telp' => '081218169269',
                'alamat' => 'Pulogadung, Jakarta',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-06 09:44:04',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
            'nama_buyer' => 'Pabrikan (Pak Ahmad) Abbas Plastindo',
                'no_telp' => '081298249900',
                'alamat' => 'Bogor',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
            'nama_buyer' => 'Pabrikan ( PT. Sumber Plastik)',
                'no_telp' => '081298048282',
                'alamat' => 'Balaraja, Kota Tangerang',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-23 16:21:18',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'nama_buyer' => 'Pabrikan Kharisma Plastik',
                'no_telp' => '08118303138',
                'alamat' => 'Bogor',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
            'nama_buyer' => 'PT. Inocycle Technology (Hilon)',
            'no_telp' => '(0345) 61384',
                'alamat' => 'Jalan Trawas km.3, Mojokerto, Desa Madyopuro RT/01 RW 01, Kalipuro, Mojekerto',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'nama_buyer' => 'Pabrik Michael Krian',
                'no_telp' => '082119171990',
                'alamat' => 'Sidoarjo, Jawa Timur',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 2,
            ),
            7 => 
            array (
                'id' => 8,
                'nama_buyer' => 'PT. Veolia Services Indonesia',
            'no_telp' => '(0343) 450711',
                'alamat' => 'Jl. Rembang Industri Raya, Jati, PIER Kec. Rembang, Pasuruan Jawa Timur',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 2,
            ),
            8 => 
            array (
                'id' => 9,
            'nama_buyer' => 'Pabrikan (PT. Inocycle Technology /PT. Hilon)',
            'no_telp' => '(0271) 852092',
                'alamat' => 'Jl. Solo Purwodadi Km.7,2 RT/RW 02/09, Desa Selorejo, Wonorejo, Kec. Gondangrejo, Kab. Karanganyar',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
            'nama_buyer' => 'Pabrikan ( PT.Sumber Makmur Sentosa Polimer)',
                'no_telp' => '000',
                'alamat' => 'Jl. Raya Tlahap, Kamal, Lumansari, Kec. Gemuh, Kab. Kendal',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-23 16:22:00',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
        ));
    }
}
