<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite_schools extends Model
{

    protected $table = 'favorite_schools';

    protected $fillable = [
        'user_id',
        'school_id'
    ];
    
}
