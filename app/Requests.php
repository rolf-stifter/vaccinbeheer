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

    public static function get_data_for_request_tabs($status, $request)
    {
        $where = [];

        if($request->get('vaccine_id')){
            $where[] = ['vaccine_id' ,'=' , $request->get('vaccine_id')];
        }
        
        if($request->get('user_id')){
            $where[] = ['user_id', '=', $request->get('user_id')];
        }

        $requests = Requests::with('vaccins', 'user')->where([
            ['status_id', '=', $status],
            [$where]  
        ])
        ->get();

        return $requests;
    }
}
