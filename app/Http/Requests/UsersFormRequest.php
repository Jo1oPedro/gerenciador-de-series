<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|string',
            'email' => 'string|email|unique:users,email',
            'password' => 'string|min:3|confirmed',
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'The :attribute is required',
            'name.min' => 'The :attribute must be greater than :min letters',
            'name.string' => 'The :attribute must be a string',
            'email.string' => 'The :attribute must be a string',
            'email.email' => 'The :attribute must be a valid email',
            'email.unique' => 'Invalid email or password',
            'password.string' => 'The :attribute must be a string',
            'password.min' => 'The :attribute must be greater/equal than :min letters',
        ];
    }
}
