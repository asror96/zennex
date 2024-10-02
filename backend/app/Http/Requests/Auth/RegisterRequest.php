<?php

declare(strict_types = 1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[А-Яа-яA-Za-z\s\-]+$/u|string|min:1|max:60',
            'email' => 'required|email|string|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*()_]/',

            ],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.regex' => 'The name may only contain letters A-z, А-я, spaces, and hyphens.',
            'name.min' => 'The name must be at least 1 character.',
            'name.max' => 'The name may not be greater than 60 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 50 characters.',
            'password.regex' => 'The password must include at least one letter, one number, and one special character.',

            'password_confirmation.required' => 'The password confirmation field is required.',
            'password_confirmation.same' => 'The password confirmation must match the password.',
        ];
    }
}
