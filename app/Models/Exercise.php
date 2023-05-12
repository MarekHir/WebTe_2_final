<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'section_title',
        'task',
        'solution',
        'picture_name',
        'points'
    ];
}
