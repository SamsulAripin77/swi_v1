<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            KategoriSeeder::class,
            JenisPlastikSeeder::class,
            JenisUsahaSeeder::class,
            SumberSampahSeeder::class,
            SupplierSeeder::class,
            BuyerSeeder::class,
            BuyerUserTableSeeder::class,
            JenisPlastikSupplierTableSeeder::class,
            JenisUsahaUserTableSeeder::class,
            JenisPlastikUserTableSeeder::class,
            SumberSampahSupplierTableSeeder::class,
            SupplierUserTableSeeder::class,
        ]);
    }
}
