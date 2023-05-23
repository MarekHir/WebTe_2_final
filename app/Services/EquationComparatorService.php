<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class EquationComparatorService {

    public function run(...$args): array
    {
        $correctAnswer = $args[0];
        $studentAnswer = $args[1];

        $process = new Process(['python3', base_path('python_files/equationComparator.py'), $correctAnswer, $studentAnswer]);
        $process->run();

        $output = $process->getOutput();
        $data = str_replace("'", '"', $output);
        $data = str_replace("\n", "", $data);

        $jsonData['result'] = $data === 'true';
        return $jsonData;
    }

}
