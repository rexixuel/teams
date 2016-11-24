<?php

use App\JobClass;
use App\JobDescription;
use App\User;
use App\Holiday;
use App\Attendance;
use App\Weekend;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('contact', 'PagesController@contact');


Route::get('/', 'AttendancesController@index');
Route::resource('attendances', 'AttendancesController');

Route::get('users/{id}/attendances/{attendanceId}', 'UsersController@attendanceShow');
Route::patch('users/{id}/attendances/{attendanceId}', 'UsersController@attendanceUpdate');
Route::get('users/{id}/attendances/{attendanceId}/edit', 'UsersController@attendanceEdit');
Route::get('users/{id}/attendances', 'UsersController@attendance');
Route::get('users/register', 'UsersController@register');
Route::get('users/search', 'UsersController@search');
Route::post('users/browse', 'UsersController@browse');
Route::get('users/browse', 'UsersController@browse');
Route::get('users/list', 'UsersController@list');
Route::resource('users', 'UsersController');
Route::get('leaves/approval', 'LeavesController@approval');
Route::get('leaves/approval/{id}', 'LeavesController@approvalAll');
Route::get('leaves/{id}/review', 'LeavesController@review');
Route::patch('leaves/{id}/approve', 'LeavesController@approve');
Route::resource('leaves', 'LeavesController');

Route::get('notifications/{id}', 'NotificationsController@show');
Route::get('notifications/{id}/send', 'NotificationsController@send');
Route::get('notifications/sendAll', 'NotificationsController@sendAll');
Route::resource('notifications', 'NotificationsController');

//maintenance / set up
Route::get('policies', 'PoliciesController@index');

Route::patch('weekends/edit', 'WeekendsController@update');
Route::get('weekends/edit', 'WeekendsController@edit');

Route::resource('holidays/browse','HolidaysController@browse');
Route::resource('holidays','HolidaysController');

Route::resource('benefits/browse','BenefitsController@browse');
Route::resource('benefits','BenefitsController');

Route::resource('jobclasses/browse','JobClassesController@browse');
Route::resource('jobclasses','JobClassesController');

Route::resource('jobs/browse','JobsController@browse');
Route::resource('jobs','JobsController');

// apis

Route::get('users/{id}/photo', function($id){

	$user = User::find($id);
	
	return response()->make($user->photo, 200, array(
        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->photo)
    ));
});

Route::get('api/dropdown', function(){
  $input = Request::get('option');  	
	$jobClass = JobClass::find($input);
	if (!empty($jobClass))
	{
		$jobDescription = $jobClass->jobDescriptions();
	}
	else
	{
		$jobDescription = new JobDescription;		
	}

	return Response::make($jobDescription->get(['id','job_description']));
});

Route::get('api/{id}/calendar', function($id){
    $date = Request::get('data');
    $month = $date['month'];
    $year = $date['year'];
    $user = new User;
    $holiday = new Holiday;

    // $holiday = $holiday->monthYear($month, $year);
    // $holidayCount = $holiday->count();
    // $holidayCount = 0;
    // if(empty($holidayCount))
    // {      
      if(Auth::user()->role <= 2)
      {
	  $attendances = $user->find($id)->attendances()->monthYear($month, $year)->get();
        //$attendances = $user->find($id)->attendances()->monthYear($month, $year)->where('time_in','>',0)->where('time_out','>',0)->get();
        $attendanceCount = $attendances->count();
        $attendances = $attendances->toArray();
        if(!empty($attendanceCount))
        {          
          $x=0;
          foreach ($attendances as $attendance) {
                    
            $attendances[$x]["id"] = "attendances/".$attendance["id"];

            if(Auth::user()->role < 2)
            {          
              $attendances[$x]["id"] = "attendances/".$attendance["id"]."/edit";
            }

            $x++;
          }        
        }      

      }
      else
      {
	  $attendances = Auth::user()->attendances()->monthYear($month, $year)->get()->toArray();
        //$attendances = Auth::user()->attendances()->monthYear($month, $year)->where('time_in','>',0)->where('time_out','>',0)->get()->toArray();
        $x=0;
        foreach ($attendances as $attendance) {
          $attendances[$x]["id"] = "attendances/".$attendance["id"];
          $x++;
        }        
      }

    // }
    // else
    // {
    //   $attendances = [];
    //   $attendances["attendance_date"] = $holiday->start_date;
    //   $attendances["time_in"] = $holiday->holiday_description;
    //   $attendances["id"] = "holidays/".$holiday->id."/edit";
    // }

  return Response::json($attendances);
});

Route::get('api/calendar', function(){
  	$date = Request::get('data');
  	$month = $date['month'];
  	$year = $date['year'];
        $attendances = Auth::user()->attendances()->monthYear($month, $year)->get()->toArray();
  	//$attendances = Auth::user()->attendances()->monthYear($month, $year)->where('time_in','>',0)->where('time_out','>',0)->get()->toArray();
    $x=0;
    foreach ($attendances as $attendance) {
      $attendances[$x]["id"] = "attendances/".$attendance["id"];
      $x++;
    }
  return Response::json($attendances);
});

Route::get('api/holidays', function(){
    $date = Request::get('data');

    $month = $date['month'];
    $year = $date['year'];

    $holidays = new Holiday;
    $holidays = $holidays->monthYear($month, $year)->get()->toArray();

    if(Auth::user()->role < 2)
    {
      $x=0;
      foreach ($holidays as $holiday) {
        $holidays[$x]["id"] = "holidays/".$holiday["id"];
        $x++;
      }      
    }
  return Response::json($holidays);
});


Route::get('api/leaves', function(){
    $date = Request::get('data');

    $month = $date['month'];
    $year = $date['year'];

    $leaves = new Leave;
    $leaves = $leaves->monthYear($month, $year)->get()->toArray();

    if(Auth::user()->role < 2)
    {
      $x=0;
      foreach ($holidays as $holiday) {
        $holidays[$x]["id"] = "holidays/".$holiday["id"];
        $x++;
      }      
    }
  return Response::json($holidays);
});

Route::get('api/weekends', function(){
  $weekends = new Weekend;

  $weekends = $weekends->where('weekend','=', 1)->get(['day']);
  return Response::json($weekends);
});

// Middleware

// Route::group(['middleware' => ['web']],function(){
// 	// 
// });

Route::auth();

Route::get('/home', 'AttendancesController@index');
Route::get('/logout', 'Auth\LoginController@logout');
