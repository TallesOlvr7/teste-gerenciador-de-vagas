<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'type'=>'required'
        ];
    }

    public function messages():array
    {
        return [
            'name.required'=>'Nome não inserido.',
            'email.required'=>'Email não iniserido.',
            'email.email'=>'Insira um email válido.',
            'email.unique'=>'Email já registrado',
            'password.require'=>'Senha não inserida.',
            'password.min'=>'A senha deve ter no mínimo seis dígitos.',
            'type.required'=>'Selecione o tipo de conta.'
        ];
    }
}
