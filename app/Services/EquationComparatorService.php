<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class EquationComparatorService {

    public function run(...$args): array
    {
        //dd($args[0]);
        //dd($args[1]);
        $process = new Process(['python3', base_path('python_files/equationComparator.py'), $args[0], $args[1]]);
        $process->run();

        $output = $process->getOutput();
        $data = str_replace("'", '"', $output);
        $data = str_replace("\n", "", $data);
        //dd($process->getErrorOutput());
        //dd($process->getOutput());

        $jsonData['isEqual'] = $data;
        return $jsonData;
    }

}
