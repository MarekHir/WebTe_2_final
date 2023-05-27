<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercises extends UserStampModel
{
    use HasFactory;

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->solved = $model->solved ?? false;
        });
    }

    public function scopeOnlyCreatedByTeacher($query, $teacher_id)
    {
        return $query->join('exercises_lists_sections', 'exercises_lists_sections.id', '=', 'exercises.exercises_lists_sections_id')
            ->join('exercises_lists', 'exercises_lists.id', '=', 'exercises_lists_sections.exercises_lists_id')
            ->where('exercises_lists.created_by', $teacher_id);
    }

    public function exercisesListsSections()
    {
        return $this->belongsTo(ExercisesListsSection::class);
    }

    public function exercisesLists()
    {
        return $this->hasOneThrough(
            ExercisesList::class,
            ExercisesListsSection::class,
            'id',
            'id',
            'exercises_lists_sections_id',
            'exercises_lists_id'
        );
    }

    protected $fillable = [
        'points',
        'solved',
        'description',
        'exercises_lists_sections_id',
        'solution'
    ];

    protected $nullable = [
        'points',
        'solution'
    ];
}
