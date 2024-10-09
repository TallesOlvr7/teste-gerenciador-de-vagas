<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{

    public function run(): void
    {
       User::create($this->makeUser('Recrutador'));
       User::create($this->makeUser('Candidato'));
       User::factory(10)->create(); 
    }

    private function makeUser(string $type):array
    {
        $email = 'talles'.$type.'@gmail.com';

        return [
            'name' => 'Talles Gabriel',
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('usuario123'),
            'type'=>$type,
            'remember_token' => Str::random(10),
        ];
    }
}
