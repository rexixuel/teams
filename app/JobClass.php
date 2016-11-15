<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobClass extends Model
{
    protected $fillable = [
    	'job_class_description',
    	'benefit_id'
    ];

    public function jobDescriptions()
    {
    	return $this->hasMany('App\JobDescription');
    }

    public function benefits()
    {
    	return $this->belongsTo('App\Benefit','benefit_id');
    }    

    public function saveJobDescription(JobDescription $jobDescription)
    {        
                
        return $this->jobDescriptions()->save($jobDescription);

    }        
}
