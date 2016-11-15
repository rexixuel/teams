<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AttendancesRequest extends Request
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
    {   $request = $this->request->all();

        if(Request::is('users/*'))
        {

            $time_in = $request["time_in"];
            $time_out = $request["time_out"];
            $lunch_in = $request["lunch_in"];
            $lunch_out = $request["lunch_out"];

        }
        
        return [
            'attendance_log' => 'sometimes|required|mimes:txt,csv',
            'time_in' => "sometimes|required|",
            'lunch_out' => 'sometimes|required|min:$time_in + 1',
            'lunch_in' => 'sometimes|required|min:$lunch_out + 1',
            'time_out' => 'sometimes|required|min:$lunch_in + 1',
        ];
    }
}
