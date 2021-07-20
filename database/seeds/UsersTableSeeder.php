<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'admin',
                'alamat' => 'Kp. Cidadap 2 Des.Girijaya Kec.Cidahu Kab.Sukabumi',
                'keterangan' => 'rusak sedang',
                'no_tlp' => '32323323',
                'created_at' => NULL,
                'updated_at' => '2021-05-28 04:02:08',
                'deleted_at' => NULL,
                'kode' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Somantri',
                'email' => 'somantri_1912@yahoo.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('passkud'),
                'remember_token' => NULL,
                'username' => 'somantri',
                'alamat' => 'Jl. Pramuka No. 10 Desa Gegerbitung, Kec. Gegerbitung',
                'keterangan' => NULL,
                'no_tlp' => '085794180080',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'kode' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'CV. Khazanah Teknik Indonesia',
                'email' => 'cvkhazanah.teknikidn@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'khazanah-giovane',
                'alamat' => 'Jl. H. Aning No. 99 RT 002 RW 001, Sangiang Jaya, Kec. Periuk, Kota Tangerang, Banten 15132',
                'keterangan' => NULL,
                'no_tlp' => '081262101220',
                'created_at' => '2021-05-06 08:51:33',
                'updated_at' => '2021-05-23 15:52:58',
                'deleted_at' => NULL,
                'kode' => 'PB1',
            ),
            3 => 
            array (
                'id' => 4,
            'name' => 'UD Arvin Barokah Jaya Plastik (ABJP)',
                'email' => 'mamunsuryadi2@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'abjp-kevin',
                'alamat' => 'Kp. Bambu Item No.55, Desa Bojong Kulur, Kecamatan Gunung Putri, Kabupaten Bogor RT/RW 02/09',
                'keterangan' => NULL,
                'no_tlp' => '081310843249',
                'created_at' => '2021-05-06 09:31:12',
                'updated_at' => '2021-05-06 09:31:12',
                'deleted_at' => NULL,
                'kode' => 'LP2',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'UD Ratu Plastik',
                'email' => 'mardianto162@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'udrp-mardianto',
                'alamat' => 'Kp. Muara Beres RT 05 RW 03, Kel. Sukahati, Kec. Cibinong, Kabupaten Bogor',
                'keterangan' => NULL,
                'no_tlp' => '081218830941',
                'created_at' => '2021-05-06 09:32:46',
                'updated_at' => '2021-05-06 09:32:46',
                'deleted_at' => NULL,
                'kode' => 'PG3',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'UD Arhenda',
                'email' => 'paratuhor@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'arhenda-dasta',
                'alamat' => 'Jalan Rawasinah, Kp. Cisalak, Sumur Batu, Kota Bekasi',
                'keterangan' => NULL,
                'no_tlp' => '08122068681',
                'created_at' => '2021-05-06 09:34:26',
                'updated_at' => '2021-05-06 09:34:26',
                'deleted_at' => NULL,
                'kode' => 'PG4',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Berdikari Plastik Sentosa',
                'email' => 'irwan_didi@yahoo.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'berdikari-irwan',
                'alamat' => 'Jl. Jengkol, Samping SMP PGRI Bumiayu, Malang',
                'keterangan' => NULL,
                'no_tlp' => '081334271942',
                'created_at' => '2021-05-06 09:37:54',
                'updated_at' => '2021-05-06 09:37:54',
                'deleted_at' => NULL,
                'kode' => 'PG5',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Daur Ulang TBI Plastik',
                'email' => 'muhammadhakimhakim5474@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'tbi-hakim',
                'alamat' => 'Taman Bringin Indah no C1 RT 04 RW 06 Ngaliyan, Semarang',
                'keterangan' => NULL,
                'no_tlp' => '081227110154',
                'created_at' => '2021-05-06 09:39:18',
                'updated_at' => '2021-05-06 09:39:18',
                'deleted_at' => NULL,
                'kode' => 'LP6',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Centra BL',
                'email' => 'info.centrabumilestari@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'centra-amelia',
                'alamat' => 'Jl. Inspeksi Cakung Drain Timur, No.617, Kec. Cakung, Kota Jakarta Timur, 13920',
                'keterangan' => NULL,
                'no_tlp' => '0811166593',
                'created_at' => NULL,
                'updated_at' => '2021-05-24 12:26:07',
                'deleted_at' => NULL,
                'kode' => 'LP7',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Trilion Multi Plastindo',
                'email' => 'trilionmultiplastindo@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => 'trilion-dhapi',
                'alamat' => 'Jl. Inspeksi Cakung Drain Timur, No.617, Kec. Cakung, Kota Jakarta Timur, 13920',
                'keterangan' => NULL,
                'no_tlp' => '08174817680',
                'created_at' => NULL,
                'updated_at' => '2021-05-24 12:30:26',
                'deleted_at' => NULL,
                'kode' => 'PB8',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('swi123ok'),
                'remember_token' => NULL,
                'username' => '@user',
                'alamat' => 'Kp. Cidadap 2 Des.Girijaya Kec.Cidahu Kab.Sukabumi',
                'keterangan' => NULL,
                'no_tlp' => '3123231231',
                'created_at' => '2021-05-25 03:28:42',
                'updated_at' => '2021-05-25 03:28:42',
                'deleted_at' => NULL,
                'kode' => 'PB9',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'super',
                'email' => 'arifins192@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('lup454nd1'),
                'remember_token' => NULL,
                'username' => '@super',
                'alamat' => 'djflksdjf',
                'keterangan' => NULL,
                'no_tlp' => '3242343254344',
                'created_at' => '2021-05-28 07:22:03',
                'updated_at' => '2021-05-28 07:22:32',
                'deleted_at' => NULL,
                'kode' => 'PB12',
            ),
        ));
        
        
    }
}
