<?php

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('suppliers')->delete();
        
        \DB::table('suppliers')->insert(array (
            0 => 
            array (
                'id' => 1,
            'nama_supplier' => 'Ibu Sarmi  (Warung rumahan)',
                'alamat' => 'Perumahan Villa Taman Cibodas',
                'no_telp' => '089506741943',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => '2021-04-21 09:40:55',
                'updated_at' => '2021-05-06 09:41:12',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 5,
            ),
            1 => 
            array (
                'id' => 2,
                'nama_supplier' => 'Pemulung Ibu Susi',
                'alamat' => 'Jl. Hj. Aming Kota Tangerang',
                'no_telp' => '083912356498',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => '2021-04-21 12:09:17',
                'updated_at' => '2021-05-06 09:42:22',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 4,
            ),
            2 => 
            array (
                'id' => 3,
                'nama_supplier' => 'Pemulung  Mama Nova',
                'alamat' => 'Jl. Hj. Aming Kota Tangerang',
                'no_telp' => '081387463904',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => '2021-05-03 01:42:39',
                'updated_at' => '2021-05-23 16:04:35',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'nama_supplier' => 'Lapak Ian',
                'alamat' => 'Bantargebang Pasang',
                'no_telp' => '081319856391',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-05-23 16:05:24',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'nama_supplier' => 'Lapak Mahmudi',
                'alamat' => 'Jatiasi, Kota Bekasi',
                'no_telp' => '087888756556',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'nama_supplier' => 'Lapak Bapak Raka',
                'alamat' => 'Bantargebang, Kota Bekasi',
                'no_telp' => '087774360671',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            6 => 
            array (
                'id' => 7,
                'nama_supplier' => 'Lapak Pak Indra',
                'alamat' => 'Karangasem Barat, Kab. Bogor',
                'no_telp' => '087874252351',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            7 => 
            array (
                'id' => 8,
                'nama_supplier' => 'Lapak H. Jumadi',
                'alamat' => 'Wanaherang Kab. Bogor',
                'no_telp' => '087870241155',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            8 => 
            array (
                'id' => 9,
                'nama_supplier' => 'Cahya',
                'alamat' => 'Citayam, Kab. Bogor',
                'no_telp' => '087884030408',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            9 => 
            array (
                'id' => 10,
                'nama_supplier' => 'Agent Lapak Andre',
                'alamat' => 'Cikarang',
                'no_telp' => '085230846845',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            10 => 
            array (
                'id' => 11,
                'nama_supplier' => 'Agent Lapak Bayu',
                'alamat' => 'Karawang',
                'no_telp' => '085230846845',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            11 => 
            array (
                'id' => 12,
                'nama_supplier' => 'Lapak Dul Hamzah',
                'alamat' => 'Jl. Merdeka Kel. Lowok Waru, Kec. Blimbing Kota Malang',
                'no_telp' => '08133772269',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            12 => 
            array (
                'id' => 13,
                'nama_supplier' => 'Pak Sariman',
                'alamat' => 'Desa Supiturang, Malang, Kota Malang',
                'no_telp' => '\'082249109007',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            13 => 
            array (
                'id' => 14,
                'nama_supplier' => 'Lapak H. Sukriadi',
                'alamat' => 'Gg 09. Muharto, Kota Malang',
                'no_telp' => '081944836488',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            14 => 
            array (
                'id' => 15,
                'nama_supplier' => 'Lapak Ibu Kusnia',
                'alamat' => 'Kec. Mijen  Kel. Karangmalang',
                'no_telp' => '081524215440',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            15 => 
            array (
                'id' => 16,
                'nama_supplier' => 'Lapak Ahmadi',
                'alamat' => 'Kec. Kaliwung Kendal Kel. Pelantaran',
                'no_telp' => '085740395208',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            16 => 
            array (
                'id' => 17,
                'nama_supplier' => 'Lapak Bagus Prambudi',
                'alamat' => 'Desa Demak, Kec. Demak Kota, Kel. Donorojo',
                'no_telp' => '082323674676',
                'lokasi_sumber_sampah' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'jenis_usaha_id' => 3,
            ),
            17 => 
            array (
                'id' => 18,
                'nama_supplier' => 'Supplier 2',
                'alamat' => 'Kp. Cidadap 2 Des.Girijaya Kec.Cidahu Kab.Sukabumi',
                'no_telp' => '23322323',
                'lokasi_sumber_sampah' => 'Kp. Cidadap',
                'created_at' => '2021-05-25 02:53:13',
                'updated_at' => '2021-05-25 02:53:13',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'nama_supplier' => 'supplier_user',
                'alamat' => 'dimana aja',
                'no_telp' => '489234324',
                'lokasi_sumber_sampah' => 'apa aja bolah',
                'created_at' => '2021-05-25 03:33:45',
                'updated_at' => '2021-05-25 03:33:45',
                'deleted_at' => NULL,
                'jenis_usaha_id' => 1,
            ),
        ));
        
        
    }
}
