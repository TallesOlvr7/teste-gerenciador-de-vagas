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
        $vacancy = $this->getVacancyForApply();

        $this->user
        ->vacancies()
        ->attach($vacancy->id);
        
        return new UserResource($this->user->vacancies());
    }

    private function getVacancyForApply():object
    {
        $vacancy = DB::table('vacancies')->where('id','=',$this->vacancyId)
        ->first();
        $this->verifyApplication($vacancy);

        return $vacancy;
    }

    private function verifyApplication(object $vacancy):void
    {
        $alreadyApplied = $this->user->vacancies()->where('vacancy_id', $vacancy->id)->exists();

        if ($alreadyApplied) {
            throw new \Exception("Você já está inscrito nessa vaga.");
        }

        if($vacancy->status != 'Aberta'){
            throw new \Exception("A vaga está fechada para inscrições.");
        }
    }
}