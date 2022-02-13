<?php

namespace Database\Seeders;

use App\Models\New_Tutorial;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Database\Seeder;


class NewTutorialSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 5000;

        for ($i = 0; $i < $limit; $i++){
            DB::table('new_tutorials')->insert([
                'user_id' => '460',
                'app_id' => $fake->numberBetween($min = 1, $max = 2),
                'title' => $fake->name,
                'content' => $fake->sentence(500),
                'image' => $fake->imageUrl($width = 200, $height = 200),
                'top' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
