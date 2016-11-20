<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Benefit;
class BenefitRequest extends Request
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
        $benefit = new Benefit;
        $benefit = $benefit->find($this->benefit);
        
        if ($benefit != null && $benefit->benefit_description != $request['benefit_description'])
        {
            return [
                'benefit_description' => 'required|unique:benefits',
                'max_vl' => 'required|min:1|max:99',
                'max_sl' => 'required|min:1|max:99',
                'allow_vl_update' => 'required|min:0|max:1',
            ];
        }
        else
        {
            return [
                'benefit_description' => 'required',
                'max_vl' => 'required|min:1|max:99',
                'max_sl' => 'required|min:1|max:99',
                'allow_vl_update' => 'required|min:0|max:1',
            ];
        }
    }
}
