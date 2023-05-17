<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        // TODO: Trans messages

        if($request->user()->cannot('viewAll', User::class))
            return response()->json(['message' => 'Not allowed'], 403);

        return User::where('role', 'student')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, string $id)
    {
        // TODO: trans message

        if($request->user()->cannot('view', User::class))
            return response()->json(['message' => 'Not allowed'], 403);

        return User::where('role', 'student')->where('id', $id)->first();
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
