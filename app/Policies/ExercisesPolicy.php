<?php

namespace App\Policies;

use App\Models\Exercises;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExercisesPolicy extends AbstractPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isTeacher() ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Exercises $exercises): bool
    {
        return $user->isStudent() ? true : false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isStudent() ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Exercises $exercises): bool
    {
        return $user->isStudent() ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Exercises $exercises): bool
    {
        return $user->isStudent() ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Exercises $exercises): bool
    {
        return $user->isTeacher() ? true : false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Exercises $exercises): bool
    {
        return $user->isStudent() ? true : false;
    }
}
