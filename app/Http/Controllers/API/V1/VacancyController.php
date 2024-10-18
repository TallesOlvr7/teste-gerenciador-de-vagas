<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GetVacanciesAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VacancyController extends Controller
{

    public function index(Request $request):JsonResponse
    {
        $status = $request->input('status');
        $type = $request->input('type');
        $param = $request->input('search');
        $vacancies = (new GetVacanciesAction($param,$status,$type))->execute();
        return response()->json($vacancies,200);
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
