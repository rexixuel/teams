<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\JobClass;
class JobClassRequest extends Request
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
        $request = $this->request->all();
        $jobClass = new JobClass;
        $jobClass = $jobClass->find($this->jobclass);
        
        if ($jobClass != null && $jobClass->job_class_description != $request['job_class_description'])
        {
            return [
                'job_class_description' => 'required|unique:job_classes',
                'benefit_id' => 'required',
            ];
        }
        else
        {
            return [
                'job_class_description' => 'required',
                'benefit_id' => 'required',
            ];
        }
    }
}
