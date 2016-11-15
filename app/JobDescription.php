<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    protected $fillable = [
    	'job_description', 
    	'job_class'
    ];

    public function jobClasses(){
		return $this->belongsTo('App\JobClass', 'job_class_id');
    }

    public function employees()
    {
        return $this->hasMany('App\User');
    } 
}
