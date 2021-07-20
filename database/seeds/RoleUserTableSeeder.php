<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        

        \DB::table('role_user')->delete();
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'user_id' => 2,
                'role_id' => 3,
            ),
            2 => 
            array (
                'user_id' => 3,
                'role_id' => 2,
            ),
            3 => 
            array (
                'user_id' => 4,
                'role_id' => 2,
            ),
            4 => 
            array (
                'user_id' => 5,
                'role_id' => 2,
            ),
            5 => 
            array (
                'user_id' => 6,
                'role_id' => 2,
            ),
            6 => 
            array (
                'user_id' => 7,
                'role_id' => 2,
            ),
            7 => 
            array (
                'user_id' => 8,
                'role_id' => 2,
            ),
            8 => 
            array (
                'user_id' => 9,
                'role_id' => 2,
            ),
            9 => 
            array (
                'user_id' => 10,
                'role_id' => 2,
            ),
            10 => 
            array (
                'user_id' => 11,
                'role_id' => 2,
            ),
            11 => 
            array (
                'user_id' => 3,
                'role_id' => 4,
            ),
            12 => 
            array (
                'user_id' => 1,
                'role_id' => 4,
            ),
            13 => 
            array (
                'user_id' => 12,
                'role_id' => 3,
            ),
        ));
        
        
    }
     
}
