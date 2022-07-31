<?php

namespace App\Http\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BankChargesValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'from_state'   => 'required',
            'to_state'     => 'required',
            'from_city'    => 'required',
            'to_city'      => 'required',
            'min_weight'   => 'required|numeric',
            'max_weight'   => 'required|numeric',
            'charges'      => 'required'
        ];
    }
    public function messages()
    {
        return [
            'form_account.required' =>'From Account field is Required.',
            'to_account.required'   =>'To Account field is Required.',
            'type.required'         =>'Type field is Required.',
            'min_weight.required'   =>'Minimum weight is Requierd.',
            'min_weight.numeric'    =>'Minimum weight field must be a numeric value.',
            'max_weight.required'   =>'Maximum weight is Requierd.',
            'max_weight.numeric'    =>'Maximum weight field must be a numeric value.',
            'charges.required'      =>'Charges field is Requierd.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       // throw new HttpResponseException();
     throw new HttpResponseException(response(json_encode(array('validation'=>$validator->errors()))));
    }
}
