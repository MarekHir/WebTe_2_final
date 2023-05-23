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

    public function show(User $student)
    {
        return $student;
    }
}
