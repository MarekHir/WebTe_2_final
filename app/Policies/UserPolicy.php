<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends AbstractPolicy
{
    public function viewAny(User $user): bool
    {
        if($user->isTeacher())
            return true;

        return false;
    }

    public function export(User $user): bool
    {
        if($user->isTeacher())
            return true;

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if($user->isTeacher() || $user->id === $model->id)
            return true;

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public function studentDashboard(User $user): bool
    {
        return $user->isStudent();
    }

    public function teacherDashboard(User $user): bool
    {
        return $user->isTeacher();
    }

    public function adminDashboard(User $user): bool
    {
        return $user->isAdmin();
    }
}
