<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authUser(AuthRequest $authRequest)
    {
        $credentials = $authRequest->validated();
    }
}
