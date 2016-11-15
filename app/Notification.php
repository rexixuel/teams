<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Notification extends Model
{
    protected $fillable = [

        'user_id',
    	'attendance_id',
    	'message',
        'mailed_status',
    	'read_status',

    ];
    
    public function scopePending($query)
    {
        return $query->where('mailed_status','=','Pending');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function attendance()
    {
        return $this->belongsTo('App\Attendance');
    }

}
