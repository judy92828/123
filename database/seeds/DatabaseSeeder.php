<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Seed_Users::class);
        $this->call(Adv_seeder::class);
        $this->call(Categories_seeder::class);
    }
}
