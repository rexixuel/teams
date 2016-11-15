<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name',
        'last_name', 'name_key',
        'emp_number',
        'role', 
        'job_description_id',
        'job_class_id', 
        'supervisor_id', 
        'rem_vl', 'rem_sl', 
        'email', 'password', 
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    use Notifiable;
    public function leaves()
    {
        return $this->hasMany('App\Leave','user_id', 'id');
    }

    public function supervisors()
    {
        return $this->belongsTo('App\Supervisor', 'supervisor_id');
    }

    public function viewLeave($user_id){
        //
    }

    public function fileLeave(Leave $leave)
    {        
                
        return $this->leaves()->save($leave);

    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance','user_id', 'id');
    }    

    public function storeAttendance(Attendance $attendance)
    {        
                
        return $this->attendances()->save($attendance);

    }

    public function jobClass()
    {
        return $this->belongsTo('App\JobClass');
    } 

    public function jobDescription()
    {
        return $this->belongsTo('App\JobDescription', 'job_description_id');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }

    public function storeNotification(Notification $notification){
        return $this->notification()->save($notification);
    }

}
