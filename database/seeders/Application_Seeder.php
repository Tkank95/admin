<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Application_Seeder extends Seeder
{
    public function run()
    {
        DB::table('applications')->insert([
            [
                'cate_id' => '0',
                'name' => 'Game',
                'logo' => 'Danh mục gốc',
                'link_download' => 'https://www.facebook.com/nguyenhuuthanh95/',
                'top' => 0,
                'status' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'cate_id' => '0',
                'name' => 'Star Show',
                'logo' => 'Danh mục gốc',
                'link_download' => 'https://www.facebook.com/nguyenhuuthanh95/',
                'top' => 0,
                'status' => '1',
                'created_at' => now(), 'updated_at' => now()
            ]
        ]);
    }
}
