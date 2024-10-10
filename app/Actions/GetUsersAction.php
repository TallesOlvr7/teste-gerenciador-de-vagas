<?php

namespace App\Actions;
use App\Http\Resources\UserResource;
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

    public function execute():UserResource
    {
        return $this->getUsers();
    }

    private function getUsers():UserResource
    {
        if($this->param || $this->userType){
            $this->makeQuery();
            $users = $this->query->paginate(10);
            return new UserResource($users);
        }
        return new UserResource(User::paginate(10));
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