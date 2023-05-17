<?php

namespace App\Http\Controllers;

use App\Models\ExercisesList;
use App\Services\LatexParseService;
use App\Services\SaveLatexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExercisesListController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ExercisesList::class, 'exercise_list');
    }


    public function index(Request $request)
    {
        if($request->user()->cannot('viewAll', ExercisesList::class))
            return response()->json(['message' => 'Not allowed'], 403);

        return ExercisesList::all();
    }

    public function store(Request $request)
    {
        // TODO: trans messages with status in steps

        if($request->user()->cannot('create', ExercisesList::class))
            return response()->json(['message' => 'Not allowed'], 403);

        $validatedData = $request->validate([
            'file' => 'required',
            'name' => 'required|string',
            'images' => 'nullable|array',
        ]);

        if (!array_key_exists('images', $validatedData))
            $validatedData['images'] = [];

        $exercise_list = ExercisesList::create(['name' => $validatedData['name'], 'user_id' => Auth::id()]);

        $save_service = app(SaveLatexService::class);
        $file_save_result = $save_service->run($exercise_list->id, $validatedData['file'], $validatedData['images']);

        $exercise_list->file_name = $file_save_result['file_name'];
        $exercise_list->base_path = $file_save_result['base_path'];
        $exercise_list->images = $file_save_result['images_paths'];
        $exercise_list->save();

        $parse_service = app(LatexParseService::class);
        $parse_result = $parse_service->run(
            base_path($file_save_result['base_path'] . '/' . $file_save_result['file_name']),
            $exercise_list->id);

        if (!$parse_result)
            return response()->json(['message' => 'Error occured while parsing'], 400);

        return response()->json([
            'exercise_list' => $exercise_list,
            'file_save_result' => $file_save_result
        ]);
    }


    public function show(ExercisesList $exercise)
    {
        //
    }

    public function update(Request $request, ExercisesList $exercise)
    {
        //
    }

    public function destroy(ExercisesList $exercise)
    {
        //
    }
}
