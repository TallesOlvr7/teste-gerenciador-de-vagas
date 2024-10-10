<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GenerateTokenAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Auth;
use Illuminate\Http\JsonResponse;
use Request;

class AuthController extends Controller
{
    public function auth(AuthRequest $authRequest):JsonResponse
    {
        $credentials = $authRequest->validated();
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email ou senha incorretos.',
            ], 400);
        }
        $token = (new GenerateTokenAction(Auth::user()))->execute();
        return response()->json([
            'message' => 'Authorized',
            'token'=> $token,
        ], 200);
    }

    public function logout():JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'Unlogged',
        ],200);
    }
}
