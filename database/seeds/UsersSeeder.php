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
    public function run()
    {
        User::truncate();
        
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make('ChangeMe'),
        ]);
        
        User::create([
            'name' => 'Front',
            'email' => 'front@test.com',
            'password' => Hash::make('ChangeMe2'),
        ]);        
    }
}