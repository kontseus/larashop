<?php

use App\Models\User;
use App\Helpers\Enums\Roles;

if (!function_exists('isAdmin'))
{
    function isAdmin(User $user): bool
    {
        return $user->role->name === Roles::Admin->value;
    }
}
