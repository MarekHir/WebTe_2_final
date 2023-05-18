<?php

namespace App\Http\Controllers;

use App\Models\Instructions;
use Illuminate\Http\Request;

class InstructionsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Instructions::class, 'instruction');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(Instructions::forRole($request->user()->role)->withUsers()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:64',
            'description' => 'required|string|max:255',
            'for_user_type' => 'required|string|in:student,teacher,all',
            'markdown' => 'required|string',
        ]);

        $instruction = new Instructions($validated_data);
        $instruction->save();

        return response()->json($instruction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructions $instruction)
    {
        return response()->json($instruction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructions $instruction)
    {
        $validated_data = $request->validate([
            'name' => 'string|max:64',
            'description' => 'string|max:255',
            'for_user_type' => 'string|in:student,teacher,all',
            'markdown' => 'string',
        ]);

        $instruction->update($validated_data);

        return response()->json($instruction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructions $instruction)
    {
        $instruction->delete();


        return response()->json(['message' => trans('validation.deleted')]);
    }
}
