<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function created_by(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updated_by(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

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
