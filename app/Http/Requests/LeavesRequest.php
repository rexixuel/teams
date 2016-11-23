<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class LeavesRequest extends Request
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

        $leavesFields = $this->request->all();

        //for testing

        // if(!empty($leavesFields['start_date'])){
        if($this->request->has('start_date')){
            $start = $leavesFields['start_date'];        
        }else{
            $start = '';
        }

        $user_id = Auth::id();
        $rules = [
            'start_date' => "sometimes|required|date|unique:leaves,start_date,NULL,id,user_id,$user_id|is_unique_range:Leave,$user_id|is_start_holiday",
            'reason' => 'required|min:5',
            'end_date' => "sometimes|required|date|after:start_date-1|unique:leaves,end_date,NULL,id,user_id,$user_id|is_unique_end_range:$start,Leave,,$user_id|is_end_holiday:$start",
            'leave_sub_type' => "sometimes|required",
        ];

        if($this->request->get("_method") != "PATCH" && !Request::is('*/approve') && !empty($leavesFields['leave_sub_type'])){

            $leavesFields = $this->request->all();

            if($leavesFields['leave_sub_type'] != "whole"){
                $leavesFields["num_days"] = ($this->request->get("num_days") / 8);
                $this->request->set('num_days', $leavesFields["num_days"]);

                if ($leavesFields['leave_sub_type'] == "half"){
                    $hours = 4;
                }elseif ($leavesFields['leave_sub_type'] == "under"){
                
                    $hours = 3;            
                }
            }

            $vl = $leavesFields["rem_vl"];
            $sl = $leavesFields["rem_sl"];

            if($leavesFields['leave_type_id'] == 1){
                if($leavesFields['leave_sub_type'] == "whole" || $leavesFields['num_days'] > $vl){
                    $rules = array_merge($rules, array('num_days' => "numeric|max:$vl|min:1"));
                }else
                {
                    $rules = array_merge($rules, array('num_days' => "numeric|max:$hours|min:1"));                
                }
            }else{
                if($leavesFields['leave_sub_type'] == "whole" || $leavesFields['num_days'] > $sl){
                    $rules = array_merge($rules, array('num_days' => "numeric|max:$sl|min:1"));
                }else{
                    $rules = array_merge($rules, array('num_days' => "numeric|max:$hours|min:1"));
                }
            }
        }

        return $rules; 
    }
}
