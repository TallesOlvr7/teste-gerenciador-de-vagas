<?php

namespace App\Actions;
use App\Http\Resources\UserCollection;
use App\Models\User;
use DB;
use Illuminate\Database\Query\Builder;

class GetUsersAction
{
    private Builder $query;
    public function __construct(
        private readonly string|null $param,
        private readonly string|null $userType,
    )
    {
        $this->query = DB::table('users');
    }

    public function execute():UserCollection
    {
        return $this->getUsers();
    }

    private function getUsers():UserCollection
    {
        if($this->param || $this->userType){
            $this->makeQuery();
            $users = $this->query->paginate(20)->withQueryString();
            return new UserCollection($users->vacancies());
        }
        return new UserCollection(User::vacancies()->paginate(20)->withQueryString());
    }

    private function makeQuery():void
    {
        if($this->param && $this->userType){
            $this->query = $this->query
            ->where('type', '=', $this->userType)
            ->whereAny([
                'name',
                'email'
            ], 'like', "%{$this->param}%");
        }

        if($this->param){
            $this->query = $this->query
            ->whereAny([
                'name',
                'email'
            ], 'like', "%{$this->param}%");
        }

        if($this->userType){
            $this->query = $this->query
            ->where('type', '=', $this->userType);
        }
    }
}