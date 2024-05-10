<?php

namespace App\Policies;

use App\Models\User;

class DutyPolicy
{
    public function before(User $user, string $ability) : bool|null
    {
        if($user->id === 397456962377482250 || $user->id === 666004073077800990) {
            return true;
        }
        return null;
    }

    public function manage(User $user): bool|null
    {
        if($user->getRole->roles->permission->hasRolePermission())
        {
            return true;
        }
        return null;
    }
}
