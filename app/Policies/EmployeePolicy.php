<?php

namespace App\Policies;

use App\Policies\Abstracts\BasePolicy;

/**
 *
 */
class EmployeePolicy extends BasePolicy
{
    public static string $permission_name = 'Employee';

}
