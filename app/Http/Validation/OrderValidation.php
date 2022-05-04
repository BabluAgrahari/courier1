<?php

namespace App\Http\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OrderValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {

        return [
            'buyer_name'   => 'required',
            'phone' => 'required',
            'phone_alt' => 'numeric',
            'email' => 'email',
            'bill_address_1' => 'required',
            'bill_address_2' => 'required',
            'bill_city' => 'required',
            'bill_country' => 'required',
            'order_channel' => 'required',
            'order_type' => 'required',
            'order_tag' => 'required',
            'bill_state' => 'required',
            'amount'    => 'required',
            'sub_total' => 'required',
            'payment_type' => 'required',
            'pickup_address_id' => 'required'
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        // throw new HttpResponseException();
        throw new HttpResponseException(response(json_encode(array('validation' => $validator->errors()))));
    }
}
