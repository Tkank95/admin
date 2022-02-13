<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Member_info extends Seeder
{
    public function run()
    {
//        $fake = Factory::create();
//
//        for ($i = 0; $i < 1000; $i++) {
//            DB::table('member_info')->insert([
//                'user_id' => $fake->numberBetween($min = 323, $max = 522),
//                'gender' => $fake->numberBetween($min = 0, $max = 1),
//                'phone' => '0123456789',
//                'birthday' => '1999-01-02',
//                'address' => 'ahihihihihihihi',
//                'facebook' => 'chịu nha',
//                'created_at' => now(),
//                'updated_at' => now()
//            ]);
//        }

        DB::table('member_info')->insert([
            [
                'user_id' => '1',
                'gender' => '1',
                'phone' => '0349368866',
                'birthday' => '1995-09-10',
                'address' => 'Hà Nội',
                'facebook' => 'https://www.facebook.com/nguyenhuuthanh95/',
                'team' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '2',
                'gender' => '1',
                'phone' => '0349368866',
                'birthday' => '1995-09-10',
                'address' => 'Hà Nội',
                'facebook' => 'https://www.facebook.com/nguyenhuuthanh95/',
                'team' => 'Tribe',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '3',
                'gender' => '0',
                'phone' => '0359364899',
                'birthday' => '1995-09-10',
                'address' => 'Hải Dương',
                'facebook' => 'https://www.facebook.com/tester',
                'team' => 'Tester',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

