<?php

namespace App\Http\Controllers;

use App\Services\LatexParseService;
use Illuminate\Http\Request;
//use PhpLatex_Parser;
//use PhpLatex_Renderer_Html;

use Symfony\Component\Process\Process;


class LatexController extends Controller
{
    //private LatexParseService $parseService;

    public function extractData(Request $request, $fileName) {
        //$this->parseService = app(LatexParseService::class);
        $parseService = app(LatexParseService::class);
        $parseService->run($fileName);
        //return view('latex', ['latex' => $output]);
    }

    public function renderSite() {
        return view('latex');
    }
}
