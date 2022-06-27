<?php

namespace App\Http\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TransportValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {

        if($request->method() == 'POST') {
            return [
                'transport_from' => 'required',
                'owner_name' => 'required',
                'mobile_no' => 'required|max:10',
                'business_name' => 'required',
                'gst_no' => 'required|unique:transports',
                'address' => 'required',
                'whatsapp_no' => 'required|max:10',
                'phone' => 'required|max:10|unique:transports',
                'email' => 'required|email|unique:transports',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'payment_accept' => 'required',
                'service_area' => 'required',
                'business_description' => 'required',
                'is_verify'     => 'required',
                'status' => 'required',
            ];
        } else {
            return [
                'transport_from' => 'required',
                'owner_name' => 'required',
                'mobile_no' => 'required',
                'business_name' => 'required',
                'gst_no' => 'required',
                'address' => 'required',
                'whatsapp_no' => 'required|max:10',
                'phone' => 'required|max:10',
                'email' => 'required|email',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'payment_accept' => 'required',
                'service_area' => 'required',
                'business_description' => 'required',
                'is_verify'     => 'required',
                'status' => 'required',
            ];
        }

    }

    protected function failedValidation(Validator $validator)
    {
        // throw new HttpResponseException();
        throw new HttpResponseException(response(json_encode(array('validation' => $validator->errors()))));
    }
}
