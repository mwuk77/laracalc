<?php

use Illuminate\Database\Seeder;

class LayoutsSeeder extends Seeder
{
    /**
     * Seed the Layouts table.
     *
     * @return void
     */    
    public function run() : void
    {
        //Layout name collides with \UI\Draw\Text\Layout
        
        \App\Layout::truncate();
        
        \App\Layout::create([
            'name' => 'simple'
        ]);
    }
}
