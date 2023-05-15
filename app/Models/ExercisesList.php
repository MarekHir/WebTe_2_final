<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesList extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'base_path',
        'name',
        'images',
    ];

    protected $hidden = [
        'id',
        'base_path',
        'file_name',
        'images',
        'created_at',
        'updated_at',
    ];

    protected $nullable = [
        'file_name',
        'base_path',
        'images',
    ];
}
