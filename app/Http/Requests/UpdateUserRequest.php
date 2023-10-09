<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            // "email" =>[
            //     'required',
            //     'email',
            //     Rule::unique('users')->ignore($this->email),
            // ],
            // "email" => "required|email|unique:users,email,$this->id,id"
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
