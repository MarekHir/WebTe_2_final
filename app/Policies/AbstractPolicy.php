<?php

namespace App\Policies;

use App\Models\User;

abstract class AbstractPolicy
{
    public function before(User $user): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }
}
