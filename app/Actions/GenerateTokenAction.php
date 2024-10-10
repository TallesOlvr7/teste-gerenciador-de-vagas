<?php

namespace App\Actions;
use Illuminate\Foundation\Auth\User;

class GenerateTokenAction
{
    public function __construct(
        private readonly User $user,
    )
    {}

    public function execute():string
    {
        return $this->generateToken();
    }

    private function generateToken():string
    {
        return $this->user->type == "Candidato"
            ? $this->user->createToken('token', ['candidate-token'])->plainTextToken
            : $this->user->createToken('token', ['recruiter-token'])->plainTextToken;
    }
}