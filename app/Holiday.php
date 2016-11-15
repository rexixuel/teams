<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Holiday extends Model
{
    protected $fillable = [

    	'holiday_description',
        'start_date',
        'end_date',
        'weekend',
    ];
    protected $date = [
        'start_date',
        'end_date',
        'created_at',
    ];

    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon\Carbon::parse($date);
    }

    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = Carbon\Carbon::parse($date);
    }

    public function setCreatedAtAttribute($date)
    {
        $this->attributes['created_at'] = Carbon\Carbon::parse($date);
    }    

    public function scopeHolidayDateRange($query, $attendanceDate)
    {
        // start_date <= attendance_date <= end_date
        return $query->where('start_date', '<=', $attendanceDate)->where('end_date', '>=', $attendanceDate);
    }
    
    public function scopeMonthYear($query,$month,$year)
    {
        return $query->whereMonth('start_date', '=', $month)->whereYear('start_date', '=', $year);
    }

     public function getDates()
    {
        return array('created_at', 'start_date', 'end_date');
    }
    public function leave()
    {
    	return $this->hasMany('App\Leave');
    }

    public function attendance()
    {
    	return $this->hasMany('App\Attendance');
    }    
}
