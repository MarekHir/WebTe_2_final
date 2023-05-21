<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class ExercisesList extends UserStampModel
{
    use HasFactory;

    public function exercisesListsSection()
    {
        return $this->hasMany(ExercisesListsSection::class, 'exercises_lists_id');
    }

    public function scopeActiveWithValidDates($query)
    {
        return $query->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('initiation')
                    ->orWhere('initiation', '<=', DB::Raw('NOW()'));
            })
            ->where(function ($query) {
                $query->whereNull('deadline')
                    ->orWhere('deadline', '>=', DB::Raw('NOW()'));
            });
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
