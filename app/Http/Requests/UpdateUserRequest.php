<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255'. $this->user->id,
            'email'=>'sometimes|email|unique:users'
        ];
    }

    public function messages():array
    {
        return [
            'email.email'=>'Insira um email válido.',
            'email.unique'=>'Email já registrado em outra conta.',
            'name.max'=>'O número máximo de caracteres é 255'
        ];
    }
}
