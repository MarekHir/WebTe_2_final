<?php

namespace App\Http\Controllers;

use App\Models\ExercisesList;
use App\Services\LatexParseService;
use App\Services\SaveLatexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExercisesListController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ExercisesList::class, 'exercises_list');
    }


    public function index(Request $request)
    {
        $validated_params = $request->validate([
            'param' => 'nullable|string',
            'search_by' => 'nullable|string|in:name'
        ]);

        if(array_key_exists('param', $validated_params) && array_key_exists('search_by', $validated_params) ){
            $result = ExercisesList::where($validated_params['search_by'], 'like', '%'.$validated_params['param'].'%')->get();
            return response()->json(collect($result)->map(function ($item) {
                return ['title' => $item['name'], 'value' => $item['id']];
            })->all());
        }

        return ExercisesList::with(['created_by'])->get();
    }

    public function store(Request $request)
    {
        // TODO: validations
        $validatedData = $request->validate([
            'file' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'images' => 'nullable|array',
            'points' => 'required|integer',
            'initiation' => 'nullable',
            'deadline' => 'nullable',
            'is_active' => 'nullable',
        ]);

        if (!array_key_exists('images', $validatedData))
            $validatedData['images'] = [];

        $create_data = collect($validatedData)->only([
            'name',
            'description',
            'points',
            'initiation',
            'deadline',
            'is_active',
        ])->toArray();

        $exercise_list = ExercisesList::create($create_data);

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
            return response()->json(['message' => trans('validation.errorParsing')], 400);

        return response()->json($exercise_list, 201);
    }


    public function show(ExercisesList $exercises_list)
    {
        return ExercisesList::where('id', $exercises_list->id)->with(['created_by'])->first();
    }

    public function update(Request $request, ExercisesList $exercises_list)
    {
        $validated_data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'points' => 'required|integer',
            'initiation' => 'nullable|date',
            'deadline' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $exercises_list->update($validated_data);
        return $exercises_list;
    }

    public function destroy(ExercisesList $exercises_list)
    {
        $exercises_list->delete();

        // TODO: trans
        return response()->json(['message' => 'Deleted exercise list']);
    }
}
