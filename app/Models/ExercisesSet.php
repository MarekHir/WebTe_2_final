<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesSet extends UserStampModel
{
    use HasFactory;

    public function exercisesLists()
    {
        return $this->belongsTo(ExercisesList::class);
    }

    protected $fillable = [
        'points',
        'deadline',
        'exercises_lists_id'
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];
}
