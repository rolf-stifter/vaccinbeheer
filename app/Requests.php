<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'vaccine_id',
        'quantity',
        'request_date',
        'status_id',
        'user_id'
    ];

    public function vaccins()
    {
        return $this->belongsTo('App\Vaccins', 'vaccine_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function search_status()
    {
        //$data = DB::table('requests')
          //          ->select('status')
    }
}
