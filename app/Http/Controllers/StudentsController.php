<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'student');
    }

    public function index(Request $request)
    {
        return QueryBuilder::for(User::class, $request)
            ->select(['users.*',
                DB::raw('(SELECT COUNT(*) FROM exercises WHERE users.id = exercises.created_by) AS num_of_exercises'),
                DB::raw('(SELECT COALESCE(SUM(points), 0) FROM exercises WHERE users.id = exercises.created_by) AS total_points'),
                DB::raw('(SELECT COUNT(*) FROM exercises WHERE users.id = exercises.created_by AND exercises.solved = true) AS num_of_solved')])
            ->allowedSorts(['id', 'first_name', 'surname', 'num_of_exercises', 'total_points', 'num_of_solved'])
            ->where('role', 'student')
            ->jsonPaginate();
    }

    public function show(Request $request, User $student)
    {
        return QueryBuilder::for(User::class, $request)
            ->allowedIncludes(['exercises.exercisesListsSections.exercisesLists'])
            ->where('id', $student->id)
            ->first();
    }
}
