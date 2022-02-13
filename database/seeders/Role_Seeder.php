<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'Quản trị hệ thống', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'developer', 'display_name' => 'Phát triển hệ thống', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'content', 'display_name' => 'Chỉnh sửa nội dung', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'mod', 'display_name' => 'Trợ lý quản trị hệ thống', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'agency', 'display_name' => 'Quản lý team idol', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
