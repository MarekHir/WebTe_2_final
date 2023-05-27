<?php

namespace App\Http\Controllers;

use App\Models\Exercises;
use App\Models\ExercisesList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'total_generated' => Exercises::where('created_by', '=', $user_id)->count(),
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

        $data['exercises_lists'] = ExercisesList::where('created_by', '=', $user_id)->limit(3)->orderBy('updated_at')->get();
        $data['exercises'] = Exercises::where('created_by', '=', $user_id)->where('solved', '=', true)
            ->with('exercisesListsSections', 'exercisesLists')->limit(3)->orderBy('updated_at')->get();
        $data['statistics'] = [
            'total_generated' => Exercises::where('created_by', '=', $user_id)->count(),
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

    public function admin()
    {
        $this->authorize('adminDashboard', User::class);

    }
}
