<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesList extends UserStampModel
{
    use HasFactory;

    public function ExercisesListsSection()
    {
        return $this->hasMany(ExercisesListsSection::class);
    }


    protected $fillable = [
        'file_name',
        'base_path',
        'user_id',
        'name',
        'description',
        'images',
        'points',
        'initiation',
        'deadline',
        'is_active',
    ];

    protected $hidden = [
        'base_path',
        'file_name',
        'images',
    ];

    protected $nullable = [
        'file_name',
        'base_path',
        'images',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'initiation' => 'datetime'
    ];
}
