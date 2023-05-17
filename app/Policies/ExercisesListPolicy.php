<?php

namespace App\Policies;

use App\Models\ExercisesList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExercisesListPolicy
{
    public function before(User $user): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->isTeacher() ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExercisesList $exercisesList): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->isTeacher() ? Response::allow() : Response::deny('avwefwf');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExercisesList $exercisesList): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExercisesList $exercisesList): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ExercisesList $exercisesList): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ExercisesList $exercisesList): bool
    {
        //
    }
}
