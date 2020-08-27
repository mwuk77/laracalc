<?php

use App\Key;
use Illuminate\Database\Seeder;

class KeysSeeder extends Seeder
{
    protected $keys = [
        [ 'label' => 'AC', 'shortcut' => 'delete', 'value' => null, 'type' => 'exec'],
        [ 'label' => '=', 'shortcut' => '=', 'value' => null, 'type' => 'exec'],        
        [ 'label' => '×', 'shortcut' => '*', 'value' => '*', 'type' => 'operator'],
        [ 'label' => '÷', 'shortcut' => '/', 'value' => '/', 'type' => 'operator'],
        [ 'label' => '+', 'shortcut' => '+', 'value' => '+', 'type' => 'operator'],
        [ 'label' => '-', 'shortcut' => '-', 'value' => '-', 'type' => 'operator'],   
        [ 'label' => '.', 'shortcut' => '.', 'value' => '.', 'type' => 'separator'], 
        //could add more here to expand for scientific mode etc.
    ];

    /**
     * Seed the Keys table.
     *
     * @return void
     */    
    public function run() : void
    {
        self::generateOperands();
        
        foreach($this->keys as $key)
        {
            Key::create($key);
        }        
    }
    
    private function generateOperands() : void
    {
        for($n = 0; $n <= 9; $n++)
        {
            $this->keys[] = [ 'label' => $n, 'shortcut' => $n, 'value' => $n, 'type' => 'operand'];
        }
    }
}
