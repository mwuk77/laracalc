<?php

use App\Layout;
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
        Layout::create([
            'name' => 'simple',
            'btns_per_row' => 4
        ]);
    }
}
