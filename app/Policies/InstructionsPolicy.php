<?php

namespace App\Policies;

use App\Models\Instructions;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InstructionsPolicy extends AbstractPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    public function generate(User $user, Instructions $instructions): bool
    {
        return $user->isStudent() && $instructions->isForStudents() || $user->isTeacher();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Instructions $instructions): bool
    {
        return $user->isStudent() && $instructions->isForStudents() || $user->isTeacher();
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
    public function update(User $user, Instructions $instructions): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $instructions);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Instructions $instructions): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $instructions);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Instructions $instructions): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $instructions);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Instructions $instructions): bool
    {
        return $this->updateDeleteRestoreForceDelete($user, $instructions);
    }

    private function updateDeleteRestoreForceDelete(User $user, Instructions $instructions): bool
    {
        return $user->isTeacher() && $user->id === $instructions->created_by;
    }
}
