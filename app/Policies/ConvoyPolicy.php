<?php

namespace App\Policies;

use App\Models\User;

class ConvoyPolicy
{
    public function before(User $user, string $ability) : bool|null
    {
        if($user->id === 397456962377482250) {
            return true;
        }
        return null;
    }

    public function create(User $user): bool
    {
        return $user->role == 'convoy_manager';
    }
}
