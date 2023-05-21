<?php

namespace App\Services;

use App\Models\Exercises;
use App\Models\ExercisesList;
use Illuminate\Support\Facades\Log;

class GenerateExercisesService extends AbstractService
{

    public function run(...$args)
    {
        $ids = $args[0];

        try {
            $exercisesLists = ExercisesList::whereIn('id', $ids)->activeWithValidDates()->with('exercisesListsSection')->get();
            foreach ($exercisesLists as $exercisesList) {
                if($exercisesList->exercisesListsSection()->count() === 0)
                    continue;

                $random_exercise_section_id = $exercisesList->exercisesListsSection()->pluck('id')->random();
                Exercises::create(['exercises_lists_sections_id' => $random_exercise_section_id]);
            }

        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }

        return true;
    }
}
