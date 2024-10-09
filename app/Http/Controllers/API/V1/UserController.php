<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GetUsersAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    public function index(Request $request):JsonResource
    {
        $searchParam = $request->input('search');
        return response()->json(new GetUsersAction($searchParam)->execute(), 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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
