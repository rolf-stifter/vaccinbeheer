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
        'quantityAfterVac'
    ];
}
