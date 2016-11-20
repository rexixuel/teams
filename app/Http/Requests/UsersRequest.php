<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use App\JobClass;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'emp_number' => 'sometimes|required|max:4|unique:users',
            'first_name' => 'sometimes|required|max:255',
            'middle_name' => 'sometimes|required|max:255',
            'last_name' => 'sometimes|required|max:255',
            'photo' => 'image|mimetypes:image/jpeg,image/png,image/jpg',
            'job_class_id' => 'sometimes|required|integer',
            'job_description_id' => 'sometimes|required|integer',
            'supervisor_id' => 'sometimes|required|integer',
            'email' => 'sometimes|required|email|max:255|',
            
        ];

        if(Request::is('users/*') && !Request::is('users/browse') )
        {   
            // get user benefits
            $request = $this->request->all();

            $user = new User();
            $jobClass = new JobClass();


            // use benefits from request NOT from user
            $jobClass = $jobClass->find($request['job_class_id']);        

            if ($jobClass->benefits->allow_vl_update)
            {            
                $rules = array_merge($rules, array('rem_vl' => "numeric|required"));
            }

            $user = $user->find($this->user);
            
            if ($user->email != $request['email'])
            {
                $rules = array_merge($rules, array('email' => 'unique:users'));
            }

        }
        else
        {
            $rules = array_merge($rules, array('email' => 'unique:users'));
        }
        return $rules;
    }
}
