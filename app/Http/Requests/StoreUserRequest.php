<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //O authorize() (junto com Policies) serve para controle de hierarquia / níveis de acesso, como admin, gerente, usuário comum, etc.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => __('message.name_required'),
            'email.required' => __('message.email_required'),
            'email.email' => __('message.email_invalid'),
            'email.unique' => __('message.email_already_in_use'),
            'password.required' => __('message.password_required'),
            'password.min' => __('message.password_min_length'),
            'password_confirmation.required' => __('message.password_confirmation_required'),
            'password.confirmed' => __('message.passwords_do_not_match'),
        ];
    }
}
