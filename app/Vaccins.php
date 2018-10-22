<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccins extends Model
{
    protected $fillable = [
        'name',
        'type',
        'minimum_amount',
        'active',
    ];

    
}
