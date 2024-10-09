<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyFactory extends Factory
{

    public function definition(): array
    {
        $collection = collect(['Pessoa Jurídica','Freelancer']);
        return [
            'title'=>fake()->words(5, true),
            'description'=>fake()->paragraphs(3, true),
            'type'=>$collection->random(),
        ];
    }
}
