<?php

namespace App\Http\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddressValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {

        return [
            'pickup_location'   => 'required',
            'address_1' => 'required',
            'pincode'   => 'numeric',
            'city'      => 'required',
            'state'     => 'required',
            'country'   => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'name'      => 'required',
            'status'    => 'required'

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // throw new HttpResponseException();
        throw new HttpResponseException(response(json_encode(array('validation' => $validator->errors()))));
    }
}
