<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GetUsersAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use User;

class UserController extends Controller
{

    public function index(Request $request):JsonResponse
    {
        $key = $request->input('search');
        $type = $request->input('type');
        $users = (new GetUsersAction($key,$type))->execute();
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        //
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
