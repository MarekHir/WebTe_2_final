<?php

namespace App\Http\Controllers;

use App\Services\LatexParseService;
use Illuminate\Http\Request;
//use PhpLatex_Parser;
//use PhpLatex_Renderer_Html;

use Symfony\Component\Process\Process;


class LatexController extends Controller
{
    private LatexParseService $parseService;

    public function extractData(Request $request, $fileName) {
        $parseService = app(LatexParseService::class);

        $file_path = base_path('public/LatexFiles/') . $fileName . '.tex';

        $process = new Process(['python3', base_path('python_files/latexParser.py'), $file_path]);
        $process->run();


        $output = $process->getOutput();
        $return_var = $process->getExitCode();

        return view('latex', ['latex' => $output]);
    }
}
