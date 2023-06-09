<?php

use App\Interfaces\IRole;

return [
    'plural' => 'Roles',
    'singular' => 'Role',
    'fields' => [
        'name' => 'Name',
        'guard_name' => 'Guard Name',
        'permissions' => 'Permissions',
        'users' => 'users',

        IRole::AdminRole => 'Admin',
        IRole::SupervisorRole => 'Supervisor',
        IRole::ForemanRole => 'Foreman',
        IRole::EmployeeRole => 'Employee',
    ],
];
