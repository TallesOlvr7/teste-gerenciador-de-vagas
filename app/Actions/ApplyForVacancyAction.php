<?php

namespace App\Actions;
use App\Http\Resources\UserResource;
use App\Models\User;
use DB;

class ApplyForVacancyAction
{
    public function __construct(
        private readonly User $user,
        private readonly string $vacancyId,
    )
    {}
    public function execute():UserResource
    {
        return $this->applyForVacancy();
    }

    private function applyForVacancy():UserResource
    {
        $this->verifyVacancyStatus();

        $this->user
        ->vacancies()
        ->attach($this->vacancyId);
        
        return new UserResource($this->user->vacancies);
    }

    private function verifyVacancyStatus():void
    {
        $vacancy = DB::table('vacancies')->where('id','=',$this->vacancyId)
        ->get();

        if($vacancy->status != 'Aberta'){
            throw new \Exception("A vaga está fechada para inscrições.");
        }
    }
}