<?php

namespace App\Helpers;

use App\Models\ExercisesList;
use App\Models\ExercisesListsSection;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\Sorts\Sort;

class SortByRelation implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $append_query = null;

        switch ($property) {
            case 'section':
                $append_query = ExercisesListsSection::select('section_title')
                    ->whereColumn('exercises_lists_sections.id', 'exercises.exercises_lists_sections_id');
                break;
            case 'list_name':
                $append_query = ExercisesList::select('name')
                    ->join('exercises_lists_sections', 'exercises_lists_sections.exercises_lists_id', '=', 'exercises_lists.id')
                    ->whereColumn('exercises_lists_sections.id', 'exercises.exercises_lists_sections_id');
                break;
            case 'max_points':
                $append_query = ExercisesList::select('points')
                    ->join('exercises_lists_sections', 'exercises_lists_sections.exercises_lists_id', '=', 'exercises_lists.id')
                    ->whereColumn('exercises_lists_sections.id', 'exercises.exercises_lists_sections_id');
                break;
            case 'full_name':
                $append_query = User::select(DB::raw("CONCAT(users.first_name, ' ', users.surname) AS full_name"))
                    ->whereColumn('users.id', 'exercises.created_by');
                break;
        }

        return $query->orderBy($append_query, $direction);
    }
}
