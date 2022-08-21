<?php

use App\Models\User;
use App\Helpers\Enums\RolesEnum;

if (!function_exists('isAdmin'))
{
    function isAdmin(User $user): bool
    {
        return $user->role->name === RolesEnum::Admin->value;
    }
}
