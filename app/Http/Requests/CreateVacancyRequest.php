<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVacancyRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>'required|max:255',
            'description'=>'required|max:500',
            'type'=>'required|in:Pessoa Jurídica,Freelacer',
        ];
    }

    public function messages():array
    {
        return[
            'title.required'=>'Por favor, insira o título da vaga.',
            'title.max'=>'O título deve ter menos que 255 caracteres.',
            'description.required'=>'Por favor, insira a descrição da vaga.',
            'description.max'=>'A descrição deve ter menos que 500 caracteres.',
            'type.required'=>'O tipo da vaga é obrigatório.',
            'type.in'=>'Insira dentre as opções disponíveis.',
        ];
    }
}
