<?php

namespace App\Http\Controllers;

use App\Helpers\SortByRelation;
use App\Models\Exercises;
use App\Services\EquationComparatorService;
use App\Services\GenerateExercisesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
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
            ->allowedSorts(['id', 'solved', 'points', 'created_at', 'created_by', 'updated_at',
                AllowedSort::custom('list_name', new SortByRelation(), 'list_name'),
                AllowedSort::custom('section', new SortByRelation(), 'section'),
                AllowedSort::custom('max_points', new SortByRelation(), 'max_points'),
                AllowedSort::custom('full_name', new SortByRelation(), 'full_name'),
            ])
            ->allowedFields(['points', 'solved', 'created_by', 'created_at', 'exercises_lists_sections_id'])
            ->allowedIncludes(['exercisesListsSections', 'created_by'])
            ->with(['exercisesLists', 'exercisesListsSections'])
            ->where(fn($query) => Auth::user()->isStudent() ? $query->where('exercises.created_by', Auth::id()) : $query)
            ->jsonPaginate();
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

        if (!$result) {
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
    public function show(Request $request, Exercises $exercise)
    {
        return QueryBuilder::for(Exercises::class, $request)
            ->allowedIncludes(['created_by'])
            ->with(['exercisesListsSections', 'exercisesLists'])
            ->find($exercise->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercises $exercise)
    {
        if(Auth::user()->isStudent())
            $validatedData = $request->validate([
                'solution' => 'required|string',
                'description' => 'nullable|string',
            ]);
        else if(Auth::user()->isTeacher()) {
            $validatedData = $request->validate([
                'points' => 'nullable|string'
            ]);
            $exercise->update($validatedData);
            return $exercise;
        }
        else {
            $validatedData = $request->validate([
                'solution' => 'required|string',
                'description' => 'nullable|string',
                'points' => 'nullable|string'
            ]);
            if(array_key_exists('points', $validatedData) && $validatedData['points'] != $exercise->points){
                $exercise->update($validatedData);
                return $exercise;
            }
        }

        $update_data = $validatedData;

        $compareService = app(EquationComparatorService::class);
        $jsonData = $compareService->run($exercise->exercisesListsSections->solution, $validatedData['solution']);

        $update_data['points'] = $jsonData['result'] ? $exercise->exercisesListsSections->exercisesLists->points : 0;
        $update_data['solved'] = true;

        $exercise->update($update_data);

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
