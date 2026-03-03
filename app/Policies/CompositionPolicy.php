<?php

namespace App\Policies;

use App\Models\Composition;
use App\Models\User;

class CompositionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Composition $composition): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['composer', 'admin']);
    }

    public function update(User $user, Composition $composition): bool
    {
        return $user->isAdmin() || $user->id === $composition->user_id;
    }

    public function delete(User $user, Composition $composition): bool
    {
        return $user->isAdmin() || $user->id === $composition->user_id;
    }

    public function updateStatus(User $user, Composition $composition): bool
    {
        return $user->isAdmin();
    }
}