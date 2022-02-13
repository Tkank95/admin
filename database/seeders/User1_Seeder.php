<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User1_Seeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create();
        $limit = 100;
        $users = [];

        for ($i = 0; $i < $limit; $i++) {
            $users = DB::table('users')->insert([
                'name' => $fake->name,
                'email' => $fake->unique()->email,
                'username' => $fake->unique()->userName,
                'password' => '$2y$10$t/seQT10LbK9aepBcbOgJOCaV64OFseO2HF4zEgiFL8pVvWoqFtVC',
                'position' => '5',
                'avatar' => '/storage/avatar/2/erbIUNgCDy20211203_1svg.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

