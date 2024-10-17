<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GetUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $key = $request->input('search');
        $type = $request->input('type');
        $users = (new GetUsersAction($key, $type))->execute();
        return response()->json($users, 200);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new UserResource(User::create($request->validated()))
        ], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }

    public function update(UpdateUserRequest $request, User $user):JsonResponse
    {
        $user->update($request->validated());
        return response()->json([
            'message' => 'Dados atualizados com sucesso.',
            'data'=> new UserResource($user),
        ], 200);
    }

    public function destroy(string $id)
    {
        //
    }
}
