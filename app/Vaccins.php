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
        'total_stock',
        'total_stock_distributed',
        'total_stock_after_vac'
    ];

    
    public static function calc()
    {
        $vaccins = Vaccins::all();
        foreach($vaccins as $vaccin){
            $total_requested = Vaccinations::where([
                ['vaccine_id', $vaccin->id],
                ['definitive', 0]
            ])
            ->sum('quantity');
            
            $vaccin->total_stock_after_vac = $vaccin->total_stock - $total_requested;
            $vaccin->save();
        }
    }
    
    public static function calc_distributed()
    {
        $vaccins = Vaccins::all();
        foreach($vaccins as $vaccin){
            $total_requested = Stock::where([
                ['vaccine_id', $vaccin->id]
            ])
            ->sum('quantity');
            
            $vaccin->total_stock_distributed = $total_requested;
            $vaccin->save();
        }
    }
}
