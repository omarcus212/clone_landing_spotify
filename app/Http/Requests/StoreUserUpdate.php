<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserUpdate extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
        ];

    }

    public function messages(): array
    {
        return [
            'email.email' => __('message.email_invalid'),
            'email.unique' => __('message.email_already_in_use'),
        ];
    }
}
