<?php

namespace App\Http\Controllers;

use App\Models\Instructions;
use Illuminate\Http\Request;

class InstructionsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Instructions::class, 'instructions');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructions $instructions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructions $instructions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructions $instructions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructions $instructions)
    {
        //
    }
}
