<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\JobClass;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/attendances';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'emp_number' => 'required|max:4',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'photo' => 'image|mimetypes:image/jpeg,image/png,image/jpg',
            'job_class_id' => 'required|integer',
            'job_description_id' => 'required|integer',
            'supervisor_id' => 'required|integer',
            'email' => 'required|email|max:255|unique:users',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // $password = str_random();
        $password = 'test1234';

        // Get the file from the request
        $file = $data['photo'];

        // Get the contents of the file
        $photo = $file->openFile()->fread($file->getSize());


        $jobClass = new JobClass;

        $jobClass = $jobClass->load('benefits')->findOrFail($data['job_class_id']);
        $benefits = $jobClass->benefits;
        // jobClass should have role as well
        return User::create([
            'emp_number' => $data['emp_number'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'photo' => $photo,
            'job_class_id' => $jobClass->id,
            'rem_vl' => $benefits->max_vl,
            'rem_sl' => $benefits->max_sl,
            'job_description_id' => $data['job_description_id'],
            'supervisor_id' => $data['supervisor_id'],
            'email' => $data['email'],
            'password' => bcrypt($password),
        ]);
    }
}
