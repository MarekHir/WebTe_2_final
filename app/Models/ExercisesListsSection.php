<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesListsSection extends Model
{
    use HasFactory;

    public function exercisesList()
    {
        return $this->belongsTo(ExercisesList::class);
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
        'section_title',
        'task',
        'solution',
        'exercises_lists_id',
        'created_at',
        'updated_at',
    ];

    protected $nullable = [
        'picture_name',
    ];
}
