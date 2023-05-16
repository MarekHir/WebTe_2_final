<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Services\EquationComparatorService;
use App\Services\LatexParseService;
use Illuminate\Http\Request;

class LatexController extends Controller
{

    public function extractData(Request $request) {
        $parseService = app(LatexParseService::class);
        $validateData = $request->validate([
            'fileName' => 'required'
        ]);
        $parseService->run($validateData['fileName']);
    }

    public function compareEquations(Request $request) {
        $validateData = $request->validate([
            'id' => 'required',
            'inputEquation' => 'required'
        ]);
        //dd($validateData);
        $compareService = app(EquationComparatorService::class);
        $exercise = Exercise::where('id', $validateData['id'])->first();
        $solution = $exercise->solution;
        //dd($solution);
        $jsonData = $compareService->run($solution, $validateData['inputEquation']);
        return response()->json($jsonData);
    }
}
