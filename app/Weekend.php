<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekend extends Model
{
    protected $fillable = [
    	'day',
        'weekend',
    ];
}
