<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function exercisesLists()
    {
        return $this->hasMany(ExercisesList::class);
    }

    public function fullName()
    {
        return $this->first_name . " " . $this->surname;
    }

    public function exercises(){
        return $this->hasMany(Exercises::class, 'created_by');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $enum = [
        'role' => ['student', 'teacher', 'admin'],
    ];

    protected $fillable = [
        'first_name',
        'surname',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
}
