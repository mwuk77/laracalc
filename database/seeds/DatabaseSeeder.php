<?php

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
        $this->call(UsersSeeder::class);
        $this->call(LayoutsSeeder::class);
        $this->call(KeysSeeder::class);
        $this->call(LayoutKeysSeeder::class);
    }
}
