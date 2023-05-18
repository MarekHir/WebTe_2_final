<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Instructions extends UserStampModel
{
    use HasFactory;

    public function scopeWithUsers(Builder $query): void
    {
        $query->with(['created_by', 'updated_by']);
    }

    public function scopeForRole(Builder $query, string $role): void
    {
        if ($role === 'student') {
            $query->where('for_user_type', '=', 'student', 'or')
                ->where('for_user_type', '=', 'all');
        }
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
