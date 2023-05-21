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

    public function exercisesListsSections()
    {
        return $this->belongsTo(ExercisesListsSection::class);
    }

    protected $fillable = [
        'points',
        'solved',
        'exercises_lists_sections_id',
        'solution'
    ];

    protected $nullable = [
        'points',
        'solution'
    ];
}
