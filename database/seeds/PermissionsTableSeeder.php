<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'referensi_access',
            ],
            [
                'id'    => 24,
                'title' => 'jenis_usaha_create',
            ],
            [
                'id'    => 25,
                'title' => 'jenis_usaha_edit',
            ],
            [
                'id'    => 26,
                'title' => 'jenis_usaha_show',
            ],
            [
                'id'    => 27,
                'title' => 'jenis_usaha_delete',
            ],
            [
                'id'    => 28,
                'title' => 'jenis_usaha_access',
            ],
            [
                'id'    => 29,
                'title' => 'setup_access',
            ],
            [
                'id'    => 30,
                'title' => 'transaksi_access',
            ],
            [
                'id'    => 31,
                'title' => 'supplier_create',
            ],
            [
                'id'    => 32,
                'title' => 'supplier_edit',
            ],
            [
                'id'    => 33,
                'title' => 'supplier_show',
            ],
            [
                'id'    => 34,
                'title' => 'supplier_delete',
            ],
            [
                'id'    => 35,
                'title' => 'supplier_access',
            ],
            [
                'id'    => 36,
                'title' => 'kategori_plastik_create',
            ],
            [
                'id'    => 37,
                'title' => 'kategori_plastik_edit',
            ],
            [
                'id'    => 38,
                'title' => 'kategori_plastik_show',
            ],
            [
                'id'    => 39,
                'title' => 'kategori_plastik_delete',
            ],
            [
                'id'    => 40,
                'title' => 'kategori_plastik_access',
            ],
            [
                'id'    => 41,
                'title' => 'jenis_plastik_create',
            ],
            [
                'id'    => 42,
                'title' => 'jenis_plastik_edit',
            ],
            [
                'id'    => 43,
                'title' => 'jenis_plastik_show',
            ],
            [
                'id'    => 44,
                'title' => 'jenis_plastik_delete',
            ],
            [
                'id'    => 45,
                'title' => 'jenis_plastik_access',
            ],
            [
                'id'    => 46,
                'title' => 'pembelian_create',
            ],
            [
                'id'    => 47,
                'title' => 'pembelian_edit',
            ],
            [
                'id'    => 48,
                'title' => 'pembelian_show',
            ],
            [
                'id'    => 49,
                'title' => 'pembelian_delete',
            ],
            [
                'id'    => 50,
                'title' => 'pembelian_access',
            ],
            [
                'id'    => 51,
                'title' => 'buyer_create',
            ],
            [
                'id'    => 52,
                'title' => 'buyer_edit',
            ],
            [
                'id'    => 53,
                'title' => 'buyer_show',
            ],
            [
                'id'    => 54,
                'title' => 'buyer_delete',
            ],
            [
                'id'    => 55,
                'title' => 'buyer_access',
            ],
            [
                'id'    => 56,
                'title' => 'penjualan_create',
            ],
            [
                'id'    => 57,
                'title' => 'penjualan_edit',
            ],
            [
                'id'    => 58,
                'title' => 'penjualan_show',
            ],
            [
                'id'    => 59,
                'title' => 'penjualan_delete',
            ],
            [
                'id'    => 60,
                'title' => 'penjualan_access',
            ],
            [
                'id'    => 61,
                'title' => 'sumber_sampah_create',
            ],
            [
                'id'    => 62,
                'title' => 'sumber_sampah_edit',
            ],
            [
                'id'    => 63,
                'title' => 'sumber_sampah_show',
            ],
            [
                'id'    => 64,
                'title' => 'sumber_sampah_delete',
            ],
            [
                'id'    => 65,
                'title' => 'sumber_sampah_access',
            ],
            [
                'id'    => 66,
                'title' => 'baseline_target_create',
            ],
            [
                'id'    => 67,
                'title' => 'baseline_target_edit',
            ],
            [
                'id'    => 68,
                'title' => 'baseline_target_show',
            ],
            [
                'id'    => 69,
                'title' => 'baseline_target_delete',
            ],
            [
                'id'    => 70,
                'title' => 'baseline_target_access',
            ],
            [
                'id'    => 71,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
