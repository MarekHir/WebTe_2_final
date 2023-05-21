<?php

namespace App\Http\Controllers;

use App\Models\Exercises;
use App\Services\EquationComparatorService;
use App\Services\GenerateExercisesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ExercisesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Exercises::class, 'exercise');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return QueryBuilder::for(Exercises::class, $request)
            ->allowedFilters(['points', AllowedFilter::exact('solved'), AllowedFilter::exact('created_by'), 'created_at', 'exercises_lists_sections_id'])
            ->allowedSorts(['id', 'points', 'solved', 'created_by', 'created_at', 'exercises_lists_sections_id'])
            ->allowedFields(['points', 'solved', 'created_by', 'created_at', 'exercises_lists_sections_id'])
            ->allowedIncludes(['exercisesListsSections'])
            ->with(['exercisesListsSections', 'exercisesListsSections.exercisesLists'])
            ->where(fn($query) => Auth::user()->isStudent() ? $query->where('created_by', Auth::id()) : $query)
            ->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'exercises_lists_sections_ids' => 'required|array',
            'exercises_lists_sections_ids.*' => 'integer',
        ]);

        $service = new GenerateExercisesService();
        $result = $service->run($validatedData['exercises_lists_sections_ids']);

        if(!$result) {
            // TODO: translate
            return response()->json(['message' => 'Failed to generate exercises'],
                ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        // TODO: translate
        return response()->json(['message' => 'Successfully generated exercises'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercises $exercise)
    {
        return Exercises::with(['exercisesListsSections', 'exercisesListsSections.exercisesLists'])->find($exercise->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercises $exercise)
    {
        $validatedData = $request->validate([
            'points' => 'required|integer|min:0',
            'solved' => 'required|boolean',
        ]);

        $exercise->update($validatedData);

//        From old LatexController
//        $validateData = $request->validate([
//            'id' => 'required',
//            'inputEquation' => 'required'
//        ]);
//        //dd($validateData);
//        $compareService = app(EquationComparatorService::class);
//        $exercise = Exercise::where('id', $validateData['id'])->first();
//        $solution = $exercise->solution;
//        //dd($solution);
//        $jsonData = $compareService->run($solution, $validateData['inputEquation']);
        return $exercise;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercises $exercise)
    {
        $exercise->delete();
    }
}
