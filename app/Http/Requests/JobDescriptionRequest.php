<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\JobDescription;
class JobDescriptionRequest extends Request
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
        $jobDescription = new JobDescription;
        $jobDescription = $jobDescription->find($this->job);
        
        if ($jobDescription != null && $jobDescription->job_description != $request['job_description'])
        {
            return [
                'job_description' => 'required|unique:job_descriptions',
                'job_class_id' => 'required',
            ];
        }
        else
        {
            return [
                'job_description' => 'required',
                'job_class_id' => 'required',
            ];
        }
        
    }
}
