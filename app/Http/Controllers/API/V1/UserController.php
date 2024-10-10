<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GetUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request):JsonResponse
    {
        $key = $request->input('search');
        $type = $request->input('type');
        $users = (new GetUsersAction($key,$type))->execute();
        return response()->json($users, 200);
    }

    public function store(CreateUserRequest $request):JsonResponse
    {
        return response()->json([
            'data'=> new UserResource(User::create($request->validated()))
        ],200);
    }

    public function show()
    {
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
