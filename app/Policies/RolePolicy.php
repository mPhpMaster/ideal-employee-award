<?php

namespace App\Policies;

use App\Policies\Abstracts\BasePolicy;

/**
 *
 */
class RolePolicy extends BasePolicy
{
    public static string $permission_name = 'Role';
}
