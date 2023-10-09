<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

      /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|min:2",
            "email" => "required|email|unique:users,email",
            // "password" => "required|min:8|max:12",
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required" => "Name can not be empty.",
            "email.required" => "Email can not be empty.",
            "password.required" => "Password can not be empty.",
        ];
    }


}
