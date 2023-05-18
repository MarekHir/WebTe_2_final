<?php

namespace App\Http\Controllers;

use App\Models\ExercisesSet;
use Illuminate\Http\Request;

class ExercisesSetsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ExercisesSet::class, 'exercises_set');
    }

    public function index()
    {
        return response()->json(ExercisesSet::with('exercisesLists', 'created_by')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'exercises_lists_id' => 'required|integer',
            'points' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        $exercisesSet = ExercisesSet::create($validated_data);

        return response()->json($exercisesSet, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExercisesSet $exercises_set)
    {
        return response()->json($exercises_set->with('exercisesLists', 'created_by')->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExercisesSet $exercises_set)
    {
        $validated_data = $request->validate([
            'exercises_lists_id' => 'nullable|integer',
            'points' => 'nullable|integer',
            'deadline' => 'nullable|date',
        ]);

        $exercises_set->update($validated_data);

        return response()->json($exercises_set);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExercisesSet $exercises_set)
    {
        $exercises_set->delete();

        // TODO: trans message
        return response()->json([
            'message' => 'Exercises set deleted successfully',
        ]);
    }
}
