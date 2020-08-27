<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label', 'shortcut', 'value', 'type'
    ];
    
    
    /**
     * The layouts that belong to the key.
     */
    public function layouts()
    {
        return $this->belongsToMany('App\Layout')->using('App\LayoutKey');
    }     

}
