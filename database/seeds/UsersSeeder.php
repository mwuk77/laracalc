<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Seed the Users table.
     *
     * @return void
     */    
    public function run() : void
    {
        User::truncate();
        
        User::create([
            'name' => 'Administrator',
            'email' => Config::get('user.admin_email'),
            'password' => Hash::make(
                Config::get('user.admin_password')
            ),
        ]);
        
        User::create([
            'name' => 'Front',
            'email' => Config::get('user.front_email'),
            'password' => Hash::make(
                Config::get('user.front_password')
            ),
        ]);        
    }
}