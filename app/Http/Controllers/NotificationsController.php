<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notification;
use App\User;
use App\Attendance;
use App\Notifications\AttendanceDiscrepancy;
use Carbon\Carbon;
class NotificationsController extends Controller
{

    public function __construct()
    
    {
        $this->middleware('auth');        
        $this->middleware('isUserAdmin', ['except' => ['show']]);
    }

    public function index()
    {

    	$notifications = new Notification;

    	$notifications = $notifications->pending()->paginate(15);

    	return view('notifications.index',compact('notifications'));
    }

    public function show($id)
    {

        $notifications = new Notification;

        $notifications = $notifications->find($id)->load('user');

        return view('notifications.show',compact('notifications'));
    }    

    public function send($id)
    {

    	$notifications = new Notification;

    	$notifications = $notifications->load('user','attendance')->findOrFail($id);
		
    	$notificationsFields["name"] = $notifications->user->first_name;

    	$notificationsFields["intro"] = "We have the following clarification(s) regarding your attendance on ".$notifications->attendance->attendance_date->format('M d, Y').": <br />";

    	$notificationsFields["message"] = $notifications->message;
    	
        $notifications->user->notify(new AttendanceDiscrepancy($notificationsFields));

        $notifications->mailed_status = "Sent";

        $notifications->push();

        return back()->with('message', $notifications->user->first_name.' '.$notifications->user->last_name.' has been notified!');

    }

    public function sendAll()
    {

    	$notifications = new Notification;

    	$notifications = $notifications->load('user','attendance')->pending()->orderBy('user_id')->get();    	
    	$current_id = $notifications->first()->user_id;
    	$current_date = Carbon::now();
        $notificationsFields["message"] = "";
        $notificationsFields["intro"] = "We would like to clarify your attendance on the following dates:";
    	
		foreach ($notifications as $notification) {

			if($notification->user_id != $current_id){
		    	$notificationsFields["name"] = $notification->user->first_name;


		        $notification->user->notify(new AttendanceDiscrepancy($notificationsFields));

		        $notificationsFields["message"] = "";

			}
			if($notification->attendance->attendance_date != $current_date){
	    		$notificationsFields["message"] = $notificationsFields["message"]."<br/> On ".$notification->attendance->attendance_date->format('M d, Y').", <br />";
			}


    		$notificationsFields["message"] = $notificationsFields["message"]."<br />".$notification->message;

    		$current_id = $notification->user_id;

		}    	

        return back()->with('message', 'Notifications has been sent!');

    }    

}
