<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'vaccine_id',
        'quantity',
        'request_date',
        'status'
    ];

    public function stock()
    {
        return $this->belongsTo('App\Stock', 'vaccine_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
