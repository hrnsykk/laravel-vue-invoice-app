<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


/**
 * Summary of AuthRegisterRequest
 */
class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|",
            "email" => "email|required|unique:users",
            "password" => "required",
            "c_password" => "required|same:password"
        ];
    }

    /**
     * Summary of failedValidation
     * @param Validator $validator
     * @throws HttpResponseException
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }

    public function messages(): array
    {
        return [
            "name.required"   => "Please fill name area",
            "email.email" => "Please fill valid mail",
            "email.required" => "Please fill email area",
            "password.required" => "Please fill password area",
            "c_password.same" => "Password and C Password Not Equal"
        ];
    }
}
