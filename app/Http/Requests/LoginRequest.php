<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
            'citizen_card' => 'required|unique:users|max:10',
            'email' => 'required|unique:users|max:50',
            'password' => 'required|min:6|max:255',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'phone_number' => 'required|unique:users|max:10',
            'address' =>'required|max:150',
       ];
    }

    public function failedValidation(Validator $validator)
    {
    throw new HttpResponseException(response()->json([
        'success'   => false,
        'message'   => 'Validation errors',
        'data'      => $validator->errors()
    ]));
    }
}
