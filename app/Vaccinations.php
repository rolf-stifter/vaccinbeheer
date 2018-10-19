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
        'user_id',
        'quantity'
    ];


    public function get_vaccine_name()
    {
        $vaccinations = DB::table('vaccinations')
                        ->leftJoin('stock', 'vaccine_id', '=', 'stock.id')
                        ->select('vaccinations.*', 'stock.productName')
                        ->get();

        return $vaccinations;
    }

    public function stock()
    {
        return $this->belongsTo('App\Stock', 'vaccine_id');
    }

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
