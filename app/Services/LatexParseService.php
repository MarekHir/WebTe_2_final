<?php

namespace App\Services;

use App\Models\ExercisesListsSection;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class LatexParseService extends AbstractService
{
    public function run(...$args)
    {
        // TODO: add correct messages for what happens and return translation keys
        $file_path = $args[0];
        $exercise_list_id = $args[1];

        $process = new Process(['python3', base_path('python_files/latexParser.py'), $file_path]);
        $process->run();

        $output = $process->getOutput();
        if($process->getExitCode() !== 0)
            return false;

        try {
            $data = json_decode($output, true);

            foreach ($data as $json) {
                $exercise = new ExercisesListsSection();
                $exercise->section_title = $json['section_title'];
                $exercise->task = $json['task'];
                $exercise->solution = $json['solution'];
                if (array_key_exists('picture_name', $json)) {
                    $exercise->picture_name = $json['picture_name'];
                }
                $exercise->exercises_lists_id = $exercise_list_id;
                $exercise->save();
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
