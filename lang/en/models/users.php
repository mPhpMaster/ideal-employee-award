<?php

use App\Interfaces\IRole;

return [
    'singular' => $singular = 'User',
    'plural' => $plural = 'Users',
    'user' => $singular,
    'users' => $plural,
    'fields' => [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'AVATAR' => 'AVATAR',
        'phone_number' => 'Phone Number',
        'role' => 'Role',
        'projects' => 'Projects',
        'image' => 'Avatar'
    ],
    'roles' => [
        IRole::AdminRole => 'Admin',
        IRole::SupervisorRole => 'Supervisor',
        IRole::ForemanRole => 'Foreman',
        IRole::EmployeeRole => 'Employee',
    ]
];
