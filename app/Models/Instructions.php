<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Instructions extends Model
{
    use HasFactory;

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::saving(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function isForStudents(): bool
    {
        return $this->for_user_type !== 'teacher';
    }

    protected $enum = [
        'for_user_type' => ['student', 'teacher', 'all'],
    ];

    protected $fillable = [
        'name',
        'description',
        'for_user_type',
        'markdown'
    ];
}
