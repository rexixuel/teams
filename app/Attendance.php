<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Attendance extends Model
{
    protected $fillable = [
    	'user_id',
    	'attendance_date',
    	'time_in',
    	'time_out',
    	'lunch_out',
        'lunch_in',
    	'late_hours',
    ];

    protected $date = [
        'attendance_date',
        // 'time_in',
        // 'time_out',
        // 'lunch_in',
        // 'lunch_out',
    ];

    public function setAttendanceDateAttribute($date)
    {
        $this->attributes['attendance_date'] = Carbon\Carbon::parse($date);
    }

    // public function setTimeInAttribute($date)
    // {
    //     $this->attributes['time_in'] = Carbon\Carbon::parse($date);
    // }

    // public function setTimeOutAttribute($date)
    // {
    //     $this->attributes['time_out'] = Carbon\Carbon::parse($date);
    // }    

    // public function setLunchInAttribute($date)
    // {
    //     $this->attributes['lunch_in'] = Carbon\Carbon::parse($date);
    // }

    // public function setLunchOutAttribute($date)
    // {
    //     $this->attributes['lunch_out'] = Carbon\Carbon::parse($date);
    // }        
    
     public function getDates()
    {
        return array('attendance_date');
    }


    public function employee()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }

    public function storeNotification(Notification $notification){
        return $this->notification()->save($notification);
    }

    public function scopeMonthYear($query,$month,$year)
    {
        return $query->whereMonth('attendance_date', '=', $month)->whereYear('attendance_date', '=', $year);
    }

    public function scopeAggregateLates($query)
    {
        return $query->sum('late_hours');
    }    

}