<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'student');
    }
    public function index()
    {
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

    public function show(User $student)
    {
        return $student;
    }

    public function edit(User $student)
    {
        //
    }

    public function update(Request $request, User $student)
    {
        //
    }

    public function destroy(User $student)
    {
        //
    }
}
