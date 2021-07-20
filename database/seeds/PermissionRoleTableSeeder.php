<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        

        \DB::table('permission_role')->delete();
        
        \DB::table('permission_role')->insert(array (
            0 => 
            array (
                'role_id' => 3,
                'permission_id' => 42,
            ),
            1 => 
            array (
                'role_id' => 3,
                'permission_id' => 15,
            ),
            2 => 
            array (
                'role_id' => 3,
                'permission_id' => 16,
            ),
            3 => 
            array (
                'role_id' => 3,
                'permission_id' => 18,
            ),
            4 => 
            array (
                'role_id' => 3,
                'permission_id' => 41,
            ),
            5 => 
            array (
                'role_id' => 3,
                'permission_id' => 2,
            ),
            6 => 
            array (
                'role_id' => 1,
                'permission_id' => 7,
            ),
            7 => 
            array (
                'role_id' => 1,
                'permission_id' => 8,
            ),
            8 => 
            array (
                'role_id' => 1,
                'permission_id' => 9,
            ),
            9 => 
            array (
                'role_id' => 1,
                'permission_id' => 10,
            ),
            10 => 
            array (
                'role_id' => 1,
                'permission_id' => 11,
            ),
            11 => 
            array (
                'role_id' => 1,
                'permission_id' => 12,
            ),
            12 => 
            array (
                'role_id' => 1,
                'permission_id' => 13,
            ),
            13 => 
            array (
                'role_id' => 1,
                'permission_id' => 14,
            ),
            14 => 
            array (
                'role_id' => 1,
                'permission_id' => 15,
            ),
            15 => 
            array (
                'role_id' => 1,
                'permission_id' => 16,
            ),
            16 => 
            array (
                'role_id' => 3,
                'permission_id' => 3,
            ),
            17 => 
            array (
                'role_id' => 3,
                'permission_id' => 4,
            ),
            18 => 
            array (
                'role_id' => 1,
                'permission_id' => 19,
            ),
            19 => 
            array (
                'role_id' => 1,
                'permission_id' => 20,
            ),
            20 => 
            array (
                'role_id' => 1,
                'permission_id' => 21,
            ),
            21 => 
            array (
                'role_id' => 1,
                'permission_id' => 22,
            ),
            22 => 
            array (
                'role_id' => 1,
                'permission_id' => 23,
            ),
            23 => 
            array (
                'role_id' => 1,
                'permission_id' => 24,
            ),
            24 => 
            array (
                'role_id' => 1,
                'permission_id' => 25,
            ),
            25 => 
            array (
                'role_id' => 1,
                'permission_id' => 26,
            ),
            26 => 
            array (
                'role_id' => 1,
                'permission_id' => 27,
            ),
            27 => 
            array (
                'role_id' => 1,
                'permission_id' => 28,
            ),
            28 => 
            array (
                'role_id' => 1,
                'permission_id' => 29,
            ),
            29 => 
            array (
                'role_id' => 1,
                'permission_id' => 30,
            ),
            30 => 
            array (
                'role_id' => 1,
                'permission_id' => 31,
            ),
            31 => 
            array (
                'role_id' => 1,
                'permission_id' => 32,
            ),
            32 => 
            array (
                'role_id' => 1,
                'permission_id' => 33,
            ),
            33 => 
            array (
                'role_id' => 1,
                'permission_id' => 34,
            ),
            34 => 
            array (
                'role_id' => 1,
                'permission_id' => 35,
            ),
            35 => 
            array (
                'role_id' => 3,
                'permission_id' => 19,
            ),
            36 => 
            array (
                'role_id' => 3,
                'permission_id' => 20,
            ),
            37 => 
            array (
                'role_id' => 3,
                'permission_id' => 27,
            ),
            38 => 
            array (
                'role_id' => 3,
                'permission_id' => 28,
            ),
            39 => 
            array (
                'role_id' => 3,
                'permission_id' => 29,
            ),
            40 => 
            array (
                'role_id' => 1,
                'permission_id' => 41,
            ),
            41 => 
            array (
                'role_id' => 1,
                'permission_id' => 42,
            ),
            42 => 
            array (
                'role_id' => 1,
                'permission_id' => 43,
            ),
            43 => 
            array (
                'role_id' => 1,
                'permission_id' => 44,
            ),
            44 => 
            array (
                'role_id' => 1,
                'permission_id' => 45,
            ),
            45 => 
            array (
                'role_id' => 1,
                'permission_id' => 46,
            ),
            46 => 
            array (
                'role_id' => 1,
                'permission_id' => 47,
            ),
            47 => 
            array (
                'role_id' => 1,
                'permission_id' => 48,
            ),
            48 => 
            array (
                'role_id' => 1,
                'permission_id' => 49,
            ),
            49 => 
            array (
                'role_id' => 1,
                'permission_id' => 50,
            ),
            50 => 
            array (
                'role_id' => 1,
                'permission_id' => 51,
            ),
            51 => 
            array (
                'role_id' => 1,
                'permission_id' => 52,
            ),
            52 => 
            array (
                'role_id' => 1,
                'permission_id' => 53,
            ),
            53 => 
            array (
                'role_id' => 1,
                'permission_id' => 54,
            ),
            54 => 
            array (
                'role_id' => 1,
                'permission_id' => 55,
            ),
            55 => 
            array (
                'role_id' => 1,
                'permission_id' => 56,
            ),
            56 => 
            array (
                'role_id' => 1,
                'permission_id' => 57,
            ),
            57 => 
            array (
                'role_id' => 1,
                'permission_id' => 58,
            ),
            58 => 
            array (
                'role_id' => 1,
                'permission_id' => 59,
            ),
            59 => 
            array (
                'role_id' => 1,
                'permission_id' => 60,
            ),
            60 => 
            array (
                'role_id' => 1,
                'permission_id' => 61,
            ),
            61 => 
            array (
                'role_id' => 1,
                'permission_id' => 62,
            ),
            62 => 
            array (
                'role_id' => 1,
                'permission_id' => 63,
            ),
            63 => 
            array (
                'role_id' => 1,
                'permission_id' => 64,
            ),
            64 => 
            array (
                'role_id' => 1,
                'permission_id' => 65,
            ),
            65 => 
            array (
                'role_id' => 1,
                'permission_id' => 66,
            ),
            66 => 
            array (
                'role_id' => 1,
                'permission_id' => 67,
            ),
            67 => 
            array (
                'role_id' => 1,
                'permission_id' => 68,
            ),
            68 => 
            array (
                'role_id' => 1,
                'permission_id' => 69,
            ),
            69 => 
            array (
                'role_id' => 1,
                'permission_id' => 70,
            ),
            70 => 
            array (
                'role_id' => 3,
                'permission_id' => 17,
            ),
            71 => 
            array (
                'role_id' => 2,
                'permission_id' => 13,
            ),
            72 => 
            array (
                'role_id' => 2,
                'permission_id' => 17,
            ),
            73 => 
            array (
                'role_id' => 2,
                'permission_id' => 18,
            ),
            74 => 
            array (
                'role_id' => 3,
                'permission_id' => 21,
            ),
            75 => 
            array (
                'role_id' => 3,
                'permission_id' => 22,
            ),
            76 => 
            array (
                'role_id' => 3,
                'permission_id' => 23,
            ),
            77 => 
            array (
                'role_id' => 3,
                'permission_id' => 24,
            ),
            78 => 
            array (
                'role_id' => 3,
                'permission_id' => 25,
            ),
            79 => 
            array (
                'role_id' => 3,
                'permission_id' => 26,
            ),
            80 => 
            array (
                'role_id' => 2,
                'permission_id' => 29,
            ),
            81 => 
            array (
                'role_id' => 2,
                'permission_id' => 30,
            ),
            82 => 
            array (
                'role_id' => 2,
                'permission_id' => 31,
            ),
            83 => 
            array (
                'role_id' => 2,
                'permission_id' => 32,
            ),
            84 => 
            array (
                'role_id' => 2,
                'permission_id' => 33,
            ),
            85 => 
            array (
                'role_id' => 2,
                'permission_id' => 34,
            ),
            86 => 
            array (
                'role_id' => 2,
                'permission_id' => 35,
            ),
            87 => 
            array (
                'role_id' => 3,
                'permission_id' => 5,
            ),
            88 => 
            array (
                'role_id' => 3,
                'permission_id' => 6,
            ),
            89 => 
            array (
                'role_id' => 3,
                'permission_id' => 7,
            ),
            90 => 
            array (
                'role_id' => 3,
                'permission_id' => 8,
            ),
            91 => 
            array (
                'role_id' => 3,
                'permission_id' => 9,
            ),
            92 => 
            array (
                'role_id' => 3,
                'permission_id' => 10,
            ),
            93 => 
            array (
                'role_id' => 3,
                'permission_id' => 11,
            ),
            94 => 
            array (
                'role_id' => 3,
                'permission_id' => 12,
            ),
            95 => 
            array (
                'role_id' => 3,
                'permission_id' => 13,
            ),
            96 => 
            array (
                'role_id' => 3,
                'permission_id' => 14,
            ),
            97 => 
            array (
                'role_id' => 2,
                'permission_id' => 46,
            ),
            98 => 
            array (
                'role_id' => 2,
                'permission_id' => 47,
            ),
            99 => 
            array (
                'role_id' => 2,
                'permission_id' => 48,
            ),
            100 => 
            array (
                'role_id' => 2,
                'permission_id' => 49,
            ),
            101 => 
            array (
                'role_id' => 2,
                'permission_id' => 50,
            ),
            102 => 
            array (
                'role_id' => 2,
                'permission_id' => 51,
            ),
            103 => 
            array (
                'role_id' => 2,
                'permission_id' => 52,
            ),
            104 => 
            array (
                'role_id' => 2,
                'permission_id' => 53,
            ),
            105 => 
            array (
                'role_id' => 2,
                'permission_id' => 54,
            ),
            106 => 
            array (
                'role_id' => 2,
                'permission_id' => 55,
            ),
            107 => 
            array (
                'role_id' => 2,
                'permission_id' => 56,
            ),
            108 => 
            array (
                'role_id' => 2,
                'permission_id' => 57,
            ),
            109 => 
            array (
                'role_id' => 2,
                'permission_id' => 58,
            ),
            110 => 
            array (
                'role_id' => 2,
                'permission_id' => 59,
            ),
            111 => 
            array (
                'role_id' => 2,
                'permission_id' => 60,
            ),
            112 => 
            array (
                'role_id' => 3,
                'permission_id' => 30,
            ),
            113 => 
            array (
                'role_id' => 3,
                'permission_id' => 31,
            ),
            114 => 
            array (
                'role_id' => 3,
                'permission_id' => 32,
            ),
            115 => 
            array (
                'role_id' => 3,
                'permission_id' => 33,
            ),
            116 => 
            array (
                'role_id' => 3,
                'permission_id' => 34,
            ),
            117 => 
            array (
                'role_id' => 3,
                'permission_id' => 35,
            ),
            118 => 
            array (
                'role_id' => 3,
                'permission_id' => 36,
            ),
            119 => 
            array (
                'role_id' => 3,
                'permission_id' => 37,
            ),
            120 => 
            array (
                'role_id' => 3,
                'permission_id' => 38,
            ),
            121 => 
            array (
                'role_id' => 3,
                'permission_id' => 39,
            ),
            122 => 
            array (
                'role_id' => 3,
                'permission_id' => 40,
            ),
            123 => 
            array (
                'role_id' => 3,
                'permission_id' => 1,
            ),
            124 => 
            array (
                'role_id' => 3,
                'permission_id' => 43,
            ),
            125 => 
            array (
                'role_id' => 3,
                'permission_id' => 44,
            ),
            126 => 
            array (
                'role_id' => 3,
                'permission_id' => 45,
            ),
            127 => 
            array (
                'role_id' => 3,
                'permission_id' => 46,
            ),
            128 => 
            array (
                'role_id' => 3,
                'permission_id' => 47,
            ),
            129 => 
            array (
                'role_id' => 3,
                'permission_id' => 48,
            ),
            130 => 
            array (
                'role_id' => 3,
                'permission_id' => 49,
            ),
            131 => 
            array (
                'role_id' => 3,
                'permission_id' => 50,
            ),
            132 => 
            array (
                'role_id' => 3,
                'permission_id' => 51,
            ),
            133 => 
            array (
                'role_id' => 3,
                'permission_id' => 52,
            ),
            134 => 
            array (
                'role_id' => 3,
                'permission_id' => 53,
            ),
            135 => 
            array (
                'role_id' => 3,
                'permission_id' => 54,
            ),
            136 => 
            array (
                'role_id' => 3,
                'permission_id' => 55,
            ),
            137 => 
            array (
                'role_id' => 3,
                'permission_id' => 56,
            ),
            138 => 
            array (
                'role_id' => 3,
                'permission_id' => 57,
            ),
            139 => 
            array (
                'role_id' => 3,
                'permission_id' => 58,
            ),
            140 => 
            array (
                'role_id' => 3,
                'permission_id' => 59,
            ),
            141 => 
            array (
                'role_id' => 3,
                'permission_id' => 60,
            ),
            142 => 
            array (
                'role_id' => 3,
                'permission_id' => 61,
            ),
            143 => 
            array (
                'role_id' => 3,
                'permission_id' => 62,
            ),
            144 => 
            array (
                'role_id' => 3,
                'permission_id' => 63,
            ),
            145 => 
            array (
                'role_id' => 3,
                'permission_id' => 64,
            ),
            146 => 
            array (
                'role_id' => 3,
                'permission_id' => 65,
            ),
            147 => 
            array (
                'role_id' => 3,
                'permission_id' => 66,
            ),
            148 => 
            array (
                'role_id' => 3,
                'permission_id' => 67,
            ),
            149 => 
            array (
                'role_id' => 3,
                'permission_id' => 68,
            ),
            150 => 
            array (
                'role_id' => 3,
                'permission_id' => 69,
            ),
            151 => 
            array (
                'role_id' => 3,
                'permission_id' => 70,
            ),
            152 => 
            array (
                'role_id' => 3,
                'permission_id' => 71,
            ),
            153 => 
            array (
                'role_id' => 2,
                'permission_id' => 71,
            ),
            154 => 
            array (
                'role_id' => 1,
                'permission_id' => 1,
            ),
            155 => 
            array (
                'role_id' => 4,
                'permission_id' => 71,
            ),
        ));
        
        
    }
}
