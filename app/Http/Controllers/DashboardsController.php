<?php

namespace App\Http\Controllers;

use App\Models\Exercises;
use App\Models\ExercisesList;
use App\Models\Instructions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardsController extends Controller
{
    public function student()
    {
        $this->authorize('studentDashboard', User::class);

        $user_id = Auth::user()->id;
        $data = [];

        $data['assigned'] = Exercises::where('created_by', '=', $user_id)->where('solved', '=', false)
            ->with('exercisesListsSections', 'exercisesLists')->limit(3)->orderBy('updated_at')->get();
        $data['solved'] = Exercises::where('created_by', '=', $user_id)->where('solved', '=', true)
            ->with('exercisesListsSections', 'exercisesLists')->limit(3)->orderBy('updated_at')->get();
        $data['statistics'] = [
            'total_generated' => Exercises::where('created_by', '=', $user_id)->where('solved', '=', false)->count(),
            'total_solved' => Exercises::where('created_by', '=', $user_id)->where('solved', '=', true)->count(),
            'earned_point' => Exercises::where('created_by', '=', $user_id)->sum('points'),
            'average_points' => Exercises::where('created_by', '=', $user_id)->where('solved', '=', true)->avg('points'),
            'total_average' => Exercises::where('exercises.created_by', '=', $user_id)->where('solved', '=', true)
                ->join('exercises_lists_sections', 'exercises_lists_sections.id', '=', 'exercises.exercises_lists_sections_id')
                ->join('exercises_lists', 'exercises_lists.id', '=', 'exercises_lists_sections.exercises_lists_id')
                ->avg('exercises_lists.points'),
            'total_points' => Exercises::where('exercises.created_by', '=', $user_id)->where('solved', '=', true)
                ->join('exercises_lists_sections', 'exercises_lists_sections.id', '=', 'exercises.exercises_lists_sections_id')
                ->join('exercises_lists', 'exercises_lists.id', '=', 'exercises_lists_sections.exercises_lists_id')
                ->sum('exercises_lists.points'),
        ];

        return $data;
    }

    public function teacher()
    {
        $this->authorize('teacherDashboard', User::class);

        $user_id = Auth::user()->id;
        $data = [];

        $data['exercises_lists'] = ExercisesList::where('created_by', '=', $user_id)->select([
                'exercises_lists.*',
                DB::raw(
                    "(SELECT COUNT(*) AS total_generated FROM exercises
                    JOIN exercises_lists_sections ON exercises_lists_sections.id = exercises.exercises_lists_sections_id
                    WHERE exercises_lists_sections.exercises_lists_id = exercises_lists.id) as total_generated"),
                DB::raw(
                    "(SELECT COUNT(*) AS total_solved FROM exercises
                    JOIN exercises_lists_sections ON exercises_lists_sections.id = exercises.exercises_lists_sections_id
                    WHERE exercises_lists_sections.exercises_lists_id = exercises_lists.id AND exercises.solved = true) as total_solved"),
                DB::raw(
                    "(SELECT ROUND(AVG(exercises.points), 2) AS solved_average FROM exercises
                    JOIN exercises_lists_sections ON exercises_lists_sections.id = exercises.exercises_lists_sections_id
                    WHERE exercises_lists_sections.exercises_lists_id = exercises_lists.id AND exercises.solved = true) as solved_average"),]
        )->limit(3)->orderBy('updated_at')->get();
        $data['exercises'] = Exercises::select('exercises.*')->with('created_by')->onlyCreatedByTeacher($user_id)
            ->with(['exercisesLists', 'exercisesListsSections'])
            ->limit(3)->orderBy('exercises.updated_at')->get();
        $data['statistics'] = [
            'lists' => ExercisesList::where('created_by', '=', $user_id)->select([
                'exercises_lists.name',
                DB::raw(
                    "(SELECT COUNT(*) AS count FROM exercises
                    JOIN exercises_lists_sections ON exercises_lists_sections.id = exercises.exercises_lists_sections_id
                    WHERE exercises_lists_sections.exercises_lists_id = exercises_lists.id) as count"),
                DB::raw(
                    "(SELECT ROUND(AVG(exercises.points), 2) AS average FROM exercises
                    JOIN exercises_lists_sections ON exercises_lists_sections.id = exercises.exercises_lists_sections_id
                    WHERE exercises_lists_sections.exercises_lists_id = exercises_lists.id) as average")])
                ->orderBy('count', 'desc')->get(),
            'top_students' => User::where('role', '=', 'student')
                ->join('exercises', 'exercises.created_by', '=', 'users.id')
                ->select([
                    DB::raw("CONCAT(users.first_name, ' ', users.surname) AS name"),
                    DB::raw(
                        "(SELECT COALESCE(SUM(exercises.points), 0) AS sum_points FROM exercises
                        WHERE exercises.created_by = users.id) as sum_points")])
                ->groupBy('users.id')
                ->orderBy('sum_points', 'desc')->limit(5)->get(),
        ];

        return $data;
    }

    public function admin()
    {
        $this->authorize('adminDashboard', User::class);

        $data = [];

        $data['users'] = User::select(DB::raw("COUNT(*) as count"), 'role')->groupBy('role')->get();
        $data['counts'] = [Exercises::count(), ExercisesList::count(), Instructions::count()];
        $data['latest_new'] = User::orderBy('created_at', 'desc')->limit(3)->get();
        $data['latest_updated'] = User::orderBy('updated_at', 'desc')->limit(3)->get();

        return $data;
    }
}
