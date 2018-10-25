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
}
