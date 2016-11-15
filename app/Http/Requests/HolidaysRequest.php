<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HolidaysRequest extends Request
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

        $holidaysFields = $this->request->all();

        if($this->request->has('start_date')){
            $start = $holidaysFields['start_date'];        
        }else{
            $start = '';
        }


        $rules = [
            'holiday_description' => "sometimes|required",
            'weekend' => "required",
            'num_days' => "numeric|min:1",
            'start_date' => "required|date|unique:holidays|is_unique_range:Holiday",
            'end_date' => "required|date|after:start_date-1|unique:holidays|is_unique_end_range:$start,Holiday",
        ];

        return $rules;
    }
}
