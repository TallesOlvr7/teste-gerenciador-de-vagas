<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>'sometimes|string|max:255',
            'description'=>'sometimes|string|max:500',
            'type'=>'sometimes|in:Pessoa Jurídica,Freelacer',
            'status'=>'sometimesin:Aberta,Fechada',
        ];
    }

    public function messages():array
    {
        return [
            'title.max'=>'O título deve ter menos que 255 caracteres.',
            'description.max'=>'A descrição deve ter menos que 500 caracteres.',
            'type.in'=>'Insira dentre as opções disponíveis.',
            'status.in'=>'Insira dentre as opções disponíveis.',
        ];
    }
}
