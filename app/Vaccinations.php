<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccinations extends Model
{
    protected $fillable = [
        'vaccination_date',
        'school_id',
        'school_class',
        'vaccine_id',
        'user_id',
        'quantity'
    ];

    public function vaccins()
    {
        return $this->belongsTo('App\Vaccins', 'vaccine_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schools()
    {
        return $this->belongsTo('App\Schools', 'school_id');
    }
}
