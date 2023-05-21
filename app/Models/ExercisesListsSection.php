<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesListsSection extends Model
{
    use HasFactory;

    public function exercisesLists()
    {
        return $this->belongsTo(ExercisesList::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercises::class);
    }

    protected $fillable = [
        'section_title',
        'task',
        'solution',
        'picture_name',
        'exercises_lists_id',
    ];

    protected $hidden = [
        'id',
        'solution',
        'exercises_lists_id',
        'created_at',
        'updated_at',
    ];

    protected $nullable = [
        'picture_name',
    ];
}
