<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_Seeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Tribe Team',
                'email' => 'support@tribeidol.com',
                'username' => 'System',
                'password' => '',
                'position' => '1',
                'avatar' => '/storage/avatar/2/HsyCB81reP20211215_anh-che-1jpg.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Nguyễn Hữu Thanh',
                'email' => 'tkank95@gmail.com',
                'username' => 'admin',
                'password' => '$2y$10$t/seQT10LbK9aepBcbOgJOCaV64OFseO2HF4zEgiFL8pVvWoqFtVC',
                'position' => '1',
                'avatar' => '/storage/avatar/2/HsyCB81reP20211215_anh-che-1jpg.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Nguyễn Thị Test',
                'email' => 'tester@gmail.com',
                'username' => 'Tester',
                'password' => '$2y$10$t/seQT10LbK9aepBcbOgJOCaV64OFseO2HF4zEgiFL8pVvWoqFtVC',
                'position' => '2',
                'avatar' => '/storage/avatar/2/HsyCB81reP20211215_anh-che-1jpg.jpg',
                'created_at' => now(), 'updated_at' => now()
            ]
        ]);
    }
}

