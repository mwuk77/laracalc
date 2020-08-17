<?php
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
            'email' => 'admin@test.com',
            'password' => Hash::make('ChangeMe2'),
        ]);        
    }
}