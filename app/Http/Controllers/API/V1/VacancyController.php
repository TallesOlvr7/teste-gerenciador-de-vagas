<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\GetVacanciesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
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

    public function store(CreateVacancyRequest $request):JsonResponse
    {
        return response()->json([
            new VacancyResource(Vacancy::create($request->validated())),
        ],201);
    }

    public function show(Vacancy $vacancy):JsonResponse
    {
        return response()->json([
            'data'=> new VacancyResource($vacancy),
        ],200);
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy):JsonResponse
    {
        $vacancy->update($request->validated());
        return response()->json([
            'messages'=>'Dados atualizados com sucesso!',
            'data'=> new VacancyResource($vacancy),
        ], 200);
    }

    public function destroy(Vacancy $vacancy):JsonResponse
    {
        $vacancy->delete();
        return response()->json('Vaga deletada com sucesso!', 200);
    }
}