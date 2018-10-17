<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccinations extends Model
{
    protected $fillable = [
        'vaccination_date',
        'school',
        'school_class',
        'vaccine_id',
        'quantity'
    ];
}
