<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercises extends UserStampModel
{
    use HasFactory;

    public function exercisesListsSection()
    {
        return $this->belongsTo(ExercisesListsSection::class);
    }

    protected $fillable = [
        'created_by',
        'updated_by'.
        'points',
        'solved'
    ];

    protected $nullable = [
        'created_by',
        'updated_by'
    ];
}
