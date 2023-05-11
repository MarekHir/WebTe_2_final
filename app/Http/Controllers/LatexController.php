<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xemlock\LaTeX\Parser\Parser;


class LatexController extends Controller
{

    public function extractData() {

        // Read the contents of the LaTeX file
        $file_contents = file_get_contents('../public/LatexFiles/blokovka01pr.tex');

        $parser = new Parser($file_contents);

        // Get the parsed content
        $parsed_content = $parser->parse()->getContent();

        // Pass the LaTeX content to the view
        return view('latex', ['latex' => $file_contents]);

        /*// Read the contents of the file
        $file_path = public_path('../public/LatexFiles/blokovka01pr.tex');
        $file_contents = file_get_contents($file_path);

        // Create a new instance of the Parser
        //$parser = new Parser();
        $parser = new PhpLatex_Parser();

        // Parse the file contents into a document object
        $document = $parser->parse($file_contents);

        var_dump($document);

        // Extract the sections, tasks, and solutions
        $sections = $document->getElementsByName('section');
        foreach ($sections as $section) {
            $section_title = $section->getTitle();

            $tasks = $section->getElementsByName('task');
            foreach ($tasks as $task) {
                $task_content = $task->getContent();

                $solutions = $task->getElementsByName('solution');
                foreach ($solutions as $solution) {
                    $solution_content = $solution->getContent();
                }
            }
        }

        return view('latex', $sections);*/
        
    }
}
