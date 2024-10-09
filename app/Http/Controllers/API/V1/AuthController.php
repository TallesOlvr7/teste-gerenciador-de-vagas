<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GenerateTokenAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function authUser(AuthRequest $authRequest):JsonResponse
    {
        $credentials = $authRequest->validated();
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email ou senha incorretos.',
            ], 400);
        }

        $user = Auth::user();
        $token = new GenerateTokenAction($user)->execute();
        return response()->json([
            'message' => 'Authorized',
            'token'=> $token,
        ], 200);
    }
}
