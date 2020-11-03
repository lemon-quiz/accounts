<?php

namespace App\Lib\Auth;

use App\Models\User;

trait RequestAuthTrait
{
    /**
     * @param User $user
     * @param string $role
     * @param string $method
     * @return false|mixed
     */
    private function hasAccess(User $user, string $role, string $method)
    {
        if (!$user) {
            return false;
        }

        $found = $user->roles->firstWhere('name', '=', $role);
        if (!$found) {
            return false;
        }
        return collect($found->pivot)->get('req_' . strtolower($method), false);
    }
}
