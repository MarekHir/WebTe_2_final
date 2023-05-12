<?php

namespace App\Http\Controllers;

use App\Services\LatexParseService;
use Illuminate\Http\Request;
//use PhpLatex_Parser;
//use PhpLatex_Renderer_Html;

use Symfony\Component\Process\Process;


class LatexController extends Controller
{

    public function extractData(Request $request, $fileName) {

        // Read the contents of the LaTeX file
        // $file_contents = file_get_contents('../public/LatexFiles/blokovka01pr.tex');
        $file_path = '../public/LatexFiles/' . $file_name . '.tex';

        $process = new Process(['python', '../../resources/python/latexParser.py', $file_path]);
        $process->run();


        $output = $process->getOutput();
        $return_var = $process->getExitCode();

        return view('latex', ['latex' => $output]);
    }
}
