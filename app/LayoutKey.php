<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LayoutKey extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order'
    ];
}
