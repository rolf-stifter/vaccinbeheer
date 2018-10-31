<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /*
    public function __construct() {
        parent::__construct();
        $this->table = config('stock');
    
    }
    */
    protected $table = 'stock';

    protected $fillable = [
        'isUsed',
        'productName',
        'quantity',
        'quantityAfterVac',
        'user_id', 
        'vaccine_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vaccins()
    {
        return $this->belongsTo('App\Vaccins', 'vaccine_id');
    }

    public static function calc_user()
    {
        $stock_lines = Stock::all();
        foreach($stock_lines as $stock_line){
            $total_requested = Vaccinations::where([
                ['vaccine_id', $stock_line->vaccine_id],
                ['user_id', $stock_line->user_id],
                ['definitive', 0]
            ])
            ->sum('quantity');

            $stock_line->quantityAfterVac = $stock_line->quantity - $total_requested;
            $stock_line->save();
        }
    }
}
