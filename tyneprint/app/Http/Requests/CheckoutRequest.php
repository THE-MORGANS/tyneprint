<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'receiver_name'=>'required',
            'receiver_email' => 'required',
            'receiver_phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'delivery_method'=>'required'
        ];
    }
}
