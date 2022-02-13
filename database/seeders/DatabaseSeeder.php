<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Application_Seeder::class);
        $this->call(User_Seeder::class);
        $this->call(Role_Seeder::class);
        $this->call(Setting_Page_Seeder::class);
//        $this->call(NewTutorialSeed::class);
    }
}
