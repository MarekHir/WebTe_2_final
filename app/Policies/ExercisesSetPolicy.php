<?php

namespace App\Policies;

use App\Models\ExercisesSet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExercisesSetPolicy extends AbstractPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExercisesSet $exercisesSet): bool
    {
        return $user->isTeacher(); //TODO: add logic for students
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExercisesSet $exercisesSet): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesSet);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExercisesSet $exercisesSet): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesSet);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ExercisesSet $exercisesSet): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesSet);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ExercisesSet $exercisesSet): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $exercisesSet);
    }

    private function updateDeleteRestoreForceDelete(User $user, ExercisesSet $exercisesSet): bool
    {
        if($user->isTeacher() && $user->id === $exercisesSet->created_by)
            return true;

        return false;
    }
}
