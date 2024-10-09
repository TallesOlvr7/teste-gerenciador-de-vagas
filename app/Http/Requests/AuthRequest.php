<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email'=>'email|required',
            'password'=>'required'
        ];
    }

    public function messages():array
    {
        return [
            'email.email'=>'Digite um email válido.',
            'email.required'=>'O email é obrigatório.',
            'password.required'=>'A senha é obrigatória.',
        ];
    }
}
