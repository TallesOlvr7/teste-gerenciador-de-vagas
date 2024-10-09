<?php

namespace App\Actions;
use App\Http\Resources\UserResource;
use App\Models\User;
use DB;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetUsersAction
{
    public function __construct(
        private readonly string $param,
    )
    {}

    public function execute():ResourceCollection
    {
        return $this->getUsers();
    }

    private function getUsers():ResourceCollection
    {
        if($this->param){
            $users = DB::table('users')
                        ->whereAny([
                            'name',
                            'email'
                        ], 'like', "%{$this->param}%")
                        ->get();
            return UserResource::collection($users);             
        }

        return UserResource::collection(User::all());
    }
}