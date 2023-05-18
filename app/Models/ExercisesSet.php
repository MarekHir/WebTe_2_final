<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesSet extends Model
{
    use HasFactory;

    public function exercisesLists()
    {
        return $this->belongsTo(ExercisesList::class);
    }

    protected $hidden = [
        'id',
        'exercises_lists_id'
    ];

    protected $fillable = [
        'points',
        'exercises_lists_id'
    ];
}
