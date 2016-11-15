<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = [
    	'user_id',
    ];

    public function info()
    {
    	return $this->belongsTo('App\User', 'user_id');

    }

    public function employees()
    {
    	return $this->hasMany('App\User');

    }    
}
