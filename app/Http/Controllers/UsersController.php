<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\AttendancesRequest;
use App\Notifications\UserUpdated;
use App\User;
use App\JobClass;
use App\Supervisor;
use Illuminate\Support\Str;
use Auth;

use Password;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

class UsersController extends Controller
{
	use ResetsPasswords;

	public function __construct()
	{
        $this->middleware('auth');
        $this->middleware('isUserHRD', ['only' => ['register', 'store', 'attendanceEdit']]);
        $this->middleware('isUserAdmin', ['only' => ['search', 'browse','attendanceShow', 'attendance']]);
	}

    public function index(){
        return redirect()->action('UsersController@search');
    }

	public function photo($id)
	{
		$user = User::find($id);
		
		return response()->make($user->photo, 200, array(
	        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->photo)
	    ));

	}

    public function search(){
        return view('users.search');
    }

    public function browse(UsersRequest $request){
        $users = new User;
        $search_name = $request['search_name'];

        $users = $users->with('jobDescription')->with('jobClass');

        if(Auth::user()->role == 2){
            $users = $users->where('supervisor_id','=',Auth::id());
        }
        $users = $users->where( function($q) use($request) {
                        $q->where('first_name','LIKE','%'.$request['search_name'].'%')
                        ->orWhere('last_name','LIKE','%'.$request['search_name'].'%');
                     })->paginate(10);
        
        return view('users.browse', compact('users', 'search_name'));
    }

    public function destroy($id)
    {
        $user = new User;
        $userInfo = $user->find($id);
        $user = $userInfo->delete();

        return back()->with('message', $userInfo->emp_number.' - '.title_case($userInfo->first_name).' '.title_case($userInfo->last_name).' has been deleted');
    }

	public function register()
	{

        $jobClasses = new JobClass;        
        $jobClasses = $jobClasses->all();

        $supervisors = new Supervisor;
        $supervisors = $supervisors->all();

		return view('users.register', compact('jobClasses', 'supervisors'));
	}

    public function edit($id)
    {

        $jobClasses = new JobClass;        
        $jobClasses = $jobClasses->all();

        $supervisors = new Supervisor;
        $supervisors = $supervisors->all();

        $user = new User;
        $user = $user->find($id);

        return view('users.edit', compact('jobClasses', 'supervisors', 'user'));
    }    


    public function update(UsersRequest $request,$id)
    {
        $user = new User;        

        $photo = $this->getPhoto($request);

        $role = $this->getRole($request);

        $name_key = $this->getNameKey($request,$id);

        $jobClass = new JobClass;
        $user = new User;

        $jobClass = $jobClass->load('benefits')->findOrFail($request['job_class_id']);
        $benefits = $jobClass->benefits;

        $userUpdateFields = ['first_name' => title_case($request['first_name']),
        'middle_name' => title_case($request['middle_name']),
        'last_name' => title_case($request['last_name']),
        'job_class_id' => $jobClass->id,
        'job_description_id' => $request['job_description_id'],
        'email' => $request['email'],
        'name_key' => $name_key,
        ];

        if(!empty($photo))
        {
            $userUpdateFields = array_merge($userUpdateFields, array('photo' => $photo));
        }

        if($role > 0)
        {
            $userUpdateFields = array_merge($userUpdateFields,array('supervisor_id' => $request['supervisor_id']));
        }

        // use benefits from request NOT from user
        $jobClass = $jobClass->find($request['job_class_id']);        

        if ($jobClass->benefits->allow_vl_update)
        {
            $userUpdateFields = array_merge($userUpdateFields,array('rem_vl' => $request['rem_vl']));
        }
        elseif($request['rem_vl'] > $jobClass->benefits->max_vl)
        {
            $request['rem_vl'] = $jobClass->benefits->max_vl;
            $userUpdateFields = array_merge($userUpdateFields,array('rem_vl' => $request['rem_vl']));            
        }


        $user = $user->find($id);
        $request['emp_number'] = $user->emp_number;
        $user->notify(new UserUpdated($user));

        $user = $user->update($userUpdateFields);

        return back()->with('message', $request['emp_number'].' - '.title_case($request['first_name']).' '.title_case($request['last_name']).' has been successfully updated!');
    }

	public function store(UsersRequest $request)
	{
        $password = str_random();        
        $supervisors = new Supervisor;


        $photo = $this->getPhoto($request);

        $role = $this->getRole($request);

        $name_key = $this->getNameKey($request,'');

        $jobClass = new JobClass;
        $user = new User;

        $jobClass = $jobClass->load('benefits')->findOrFail($request['job_class_id']);
        $benefits = $jobClass->benefits;

        $user = $user->create([
            'emp_number' => $request['emp_number'],
            'first_name' => title_case($request['first_name']),
            'middle_name' => title_case($request['middle_name']),
            'last_name' => title_case($request['last_name']),
            'photo' => $photo,
            'job_class_id' => $jobClass->id,
            'rem_vl' => $benefits->max_vl,
            'rem_sl' => $benefits->max_sl,
            'job_description_id' => $request['job_description_id'],
            'supervisor_id' => $request['supervisor_id'],
            'email' => $request['email'],
            'password' => bcrypt($password),
            'role' => $role,
            'name_key' => $name_key,
        ]); 

        if($role == 2){
            $supervisors->create(['user_id' => $user->id]);
        }

		$this->sendResetLinkEmail($request);
        
		return back()->with('message', title_case($request['first_name']).' '.title_case($request['last_name']).' has been successfully registered!');
	}

    public function getPhoto($request)
    {
        // Get the file from the request
        $file = $request['photo'];

        // Get the contents of the file
        if(!empty($file))
        {
            return $photo = $file->openFile()->fread($file->getSize());            
        }
        else{
            return $photo = '';
        }
    }

    public function getRole($request)
    {
        $jobClass = new JobClass;
        $user = new User;

        $jobClass = $jobClass->load('benefits')->findOrFail($request['job_class_id']);
        $benefits = $jobClass->benefits;
        
        if (strtoupper($jobClass->job_class_description) < 'F')
        {
            return $role = 3; 
        }
        elseif (strtoupper($jobClass->job_class_description) == 'ADMIN')
        {
            return $role = 1;
        }
        else
        {
            return $role = 2;
        }        

    }

    public function getNameKey($request,$id)
    {
        $tie_breaker = "";
        $name_key = $request['last_name'].", ".$request['first_name']." ".$request['middle_name'].$tie_breaker;
        $name_key = title_case($name_key);
        $user = new User;
        $count = 0;
        // dd($request->path());
        $userIdPath = "users/".$id;
        if($request->is('users/*'))
        {
            $userNameKey = $user->find($id)->name_key;            
        }else{
            $userNameKey = '';
        }
        if($userNameKey != $name_key || $request->is('users'))
        {            
            do{            
                $userNameKeyCount = $user->where('name_key','=',$name_key)->count();

                if($userNameKeyCount > 0){
                    $count++;
                    $tie_breaker = $count;
                    $name_key = $name_key." - ".$tie_breaker;
                }

            }while($userNameKeyCount > 0);
        }

        return $name_key;        
    }

    public function attendance($id)
    {
        $url = 'api/'.$id.'/calendar';
        $urlLeaves = 'api/'.$id.'/leaves';
        // $link = 
        $user = User::find($id);
        return view('attendances.index',compact('url', 'user'));
    }

    public function attendanceShow($id, $attendanceId){
        $user = new User;
        $attendances = $user->find($id)->attendances()->with('employee')->find($attendanceId);
        
        return view('attendances.show', compact('attendances'));
    }

    public function attendanceEdit($id, $attendanceId){
        $user = new User;
        $attendances = $user->find($id)->attendances()->with('employee')->find($attendanceId);
        
        return view('attendances.edit', compact('attendances'));
    }

    public function attendanceUpdate($id, $attendanceId, AttendancesRequest $request)
    {
        $user = new User;
        $attendanceRequest = $request;
        $attendances = $user->find($id)->attendances()->with('employee')->find($attendanceId);

        $attendances->time_in = $attendanceRequest["time_in"];
        $attendances->lunch_in = $attendanceRequest["lunch_in"];
        $attendances->lunch_out = $attendanceRequest["lunch_out"];
        $attendances->time_out = $attendanceRequest["time_out"];

        $attendances->push();

        return back()->with('message', $attendances->employee->emp_number.' - '.title_case($attendances->employee->first_name).' '.title_case($attendances->employee->last_name).' \'s attendance has been successfully updated!');
    }    
}