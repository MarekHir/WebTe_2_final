<?php

namespace App\Policies;

use App\Models\ExercisesList;
use App\Models\User;

class ExercisesListPolicy extends AbstractPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExercisesList $exercisesList): bool
    {
        return $user->isTeacher() || $user->isStudent() && $exercisesList->is_active;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher() ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExercisesList $exercisesList): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesList);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExercisesList $exercisesList): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesList);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ExercisesList $exercisesList): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesList);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ExercisesList $exercisesList): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesList);
    }

    private function updateDeleteRestoreForceDelete(User $user, ExercisesList $exercisesList): bool
    {
        if($user->isTeacher() && $user->id === $exercisesList->created_by)
            return true;

        return false;
    }
}
