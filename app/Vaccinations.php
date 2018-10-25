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

    public static function get_planned_vaccinations_for_user($user)
    {
        $vaccinations_planned = Vaccinations::with('vaccins', 'user', 'schools')->where([
            ['vaccination_date' ,'>=' , date('Y/m/d')],
            ['user_id', '=', $user]   
            ])
            ->get();

        return $vaccinations_planned;
    }

    public static function get_finished_vaccinations_for_user($user)
    {
        $vaccinations_finished = Vaccinations::with('vaccins', 'user', 'schools')->where([
            ['vaccination_date' ,'<' , date('Y/m/d')],
            ['user_id', '=', $user]   
            ])
            ->get();

        return $vaccinations_finished;
    }

    public static function get_planned_vaccinations()
    {
        $vaccinations_planned = Vaccinations::with('vaccins', 'user', 'schools')->where([
            ['vaccination_date' ,'>=' , date('Y/m/d')]
            ])
            ->get();

        return $vaccinations_planned;
    }

    public static function  get_finished_vaccinations()
    {
        $vaccinations_finished = Vaccinations::with('vaccins', 'user', 'schools')->where([
            ['vaccination_date' ,'<' , date('Y/m/d')],
            ])
            ->get();

        return $vaccinations_finished;
    }
}
