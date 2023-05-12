<?php

namespace App\Services;

use App\Models\Exercise;
use Symfony\Component\Process\Process;

class LatexParseService extends AbstractService
{
    public function run(...$args): void
    {
        // TODO: Implement run() method.
        $file_path = base_path('public/LatexFiles/') . $args[0];

        $process = new Process(['python3', base_path('python_files/latexParser.py'), $file_path]);
        $process->run();

        $output = $process->getOutput();
        $data = str_replace("'", '"', $output);

        $return_var = $process->getExitCode();
        //dd($process->getErrorOutput());
        //dd($output);

        $pattern = '/\{([^}]*)}/';
        preg_match_all($pattern, $data, $exercise_arrays);

        //$exercise_arrays = json_decode($output, false);
        //dd($exercise_arrays);

        foreach ($exercise_arrays[0] as $array) {
            $json = json_decode($array, true);
            $exercise = new Exercise();
            $exercise->file_name = $json['file_name'];
            $exercise->section_title = $json['section_title'];
            $exercise->task = $json['task'];
            $exercise->solution = $json['solution'];
            $exercise->picture_name = $json['picture_name'];
            $exercise->points = 6;
            $exercise->save();
        }
    }
}
