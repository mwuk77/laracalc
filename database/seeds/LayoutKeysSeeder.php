<?php

use Illuminate\Database\Seeder;

use App\Layout;
use App\Key;
use App\LayoutKey;

class LayoutKeysSeeder extends Seeder
{
    //Key.labels in display order.
    protected $layout_keys = [
        'simple' => [
                          'AC',
            '7', '8', '9', '×',
            '4', '5', '6', '-',
            '1', '2', '3', '+',
            '0', '.', '÷', '='
        ]
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {       
        foreach($this->layout_keys as $layout => $key_labels)
        {
            //get Layout ID for $layout_keys[key]
            $l_id = Layout::where('name', $layout)->first()['id'];
            
            //ordering index
            $order = 0;
            
            foreach($key_labels as $key_label)
            {
                //get Key IDs by label
                $k_id = Key::where('label', $key_label)->first()['id'];
                
                LayoutKey::create([
                    'order' => $order,
                    'layout_id' => $l_id,
                    'key_id' =>  $k_id
                ]);
                
                $order ++;
            }
        }
    }
}
