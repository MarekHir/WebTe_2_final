<?php

namespace App\Http\Controllers;

use App\Models\Exercises;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated_params = $request->validate([
            'param' => 'nullable|string',
            'search_by' => 'nullable|string|in:name',
            'order' => 'nullable|string'
        ]);

        $query = Exercises::query();

        if (array_key_exists('param', $validated_params) && array_key_exists('search_by', $validated_params)) {
            $query->where($validated_params['search_by'], 'like', '%' . $validated_params['param'] . '%');
        }

        if (array_key_exists('order', $validated_params)) {
            $order = $validated_params['order'];
            $descending = false;
    
            if (substr($order, 0, 1) === '-') {
                $descending = true;
                $order = substr($order, 1);
            }
    
            $query->orderBy($order, $descending ? 'desc' : 'asc');
        }
    
        $result = $query->get();
    
        return response()->json($result->map(function ($item) {
            return ['solved' => $item['solved'], 'points' => $item['points'], 'id' => $item['id']];
        })->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
            'points' => 'required|integer|min:0',
            'solved' => 'required|boolean',
        ]);

        $exercise = Exercises::create($validatedData);

        return $exercise;
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercises $exercises)
    {
        return $exercises;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercises $exercises)
    {
        $validatedData = $request->validate([
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ]);
    
        $exercises->update($validatedData);
        return $exercises;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercises $exercises)
    {
        $exercises->delete();
    }
}
