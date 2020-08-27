<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'btns_per_row'
    ];
    
    /**
     * The keys that belong to the layout.
     */
    public function keys()
    {
        return $this->belongsToMany('App\Key', 'layout_key', 'layout_id', 'key_id')
                ->withPivot('layout_id', 'key_id', 'order')
                ->orderBy('layout_key.order');
    } 
}
