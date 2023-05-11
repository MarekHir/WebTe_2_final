<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use PhpLatex_Parser;
//use PhpLatex_Renderer_Html;

use Symfony\Component\Process\Process;


class LatexController extends Controller
{

    public function extractData(Request $request) {

        $file_name = $request->input('name');
        // Read the contents of the LaTeX file
        // $file_contents = file_get_contents('../public/LatexFiles/blokovka01pr.tex');
        $file_path = '../public/LatexFiles/' . $file_name . '.tex';

        $process = new Process(['python', '../../resources/python/latexParser.py', $file_path]);
        $process->run();

        $output = $process->getOutput();
        $return_var = $process->getExitCode();

        return view('latex', ['latex' => $output]);

        /*//$parser = new Parser($file_contents);
        $parser = new PhpLatex_Parser();

        // Get the parsed content
        $parsed_content = $parser->parse($file_contents);

        $htmlRenderer = new PhpLatex_Renderer_Html();
        $html = $htmlRenderer->render($parsed_content);

        // Pass the LaTeX content to the view
        return view('latex', ['latex' => $html]);*/
    }
}
