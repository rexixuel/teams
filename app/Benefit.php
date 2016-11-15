<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = [
    	'benefit_description',
    	'max_sl',
    	'max_vl',
    	'allow_vl_update'
    ];

    public function jobClasses()
    {
    	return $this->hasMany('App\JobClass');
    }

    public function saveJobClass(JobClass $jobClass)
    {        
                
        return $this->jobClasses()->save($jobClass);

    }            
}
