<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'applications' => [
        'name' => 'Applications',
        'index_title' => 'Applications List',
        'new_title' => 'New Application',
        'create_title' => 'Create Application',
        'edit_title' => 'Edit Application',
        'show_title' => 'Show Application',
        'inputs' => [
            'direct_boss_id' => 'Direct Boss',
            'employee_id' => 'Employee',
            'supervisor_committee_id' => 'Supervisor Committee',
            'technical_committee_id' => 'Technical Committee',
            'award_id' => 'Award',
            'rank' => 'Rank',
            'direct_boss_points' => 'Direct Boss Points',
            'supervisor_committee_points' => 'Supervisor Committee Points',
            'technical_committee_points' => 'Technical Committee Points',
            'employee_points' => 'Employee Points',
        ],
    ],

    'awards' => [
        'name' => 'Awards',
        'index_title' => 'Awards List',
        'new_title' => 'New Award',
        'create_title' => 'Create Award',
        'edit_title' => 'Edit Award',
        'show_title' => 'Show Award',
        'inputs' => [
            'type' => 'Type',
            'max_employee_points' => 'Max Employee Points',
        ],
    ],

    'positions' => [
        'name' => 'Positions',
        'index_title' => 'Positions List',
        'new_title' => 'New Position',
        'create_title' => 'Create Position',
        'edit_title' => 'Edit Position',
        'show_title' => 'Show Position',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'direct_bosses' => [
        'name' => 'Direct Bosses',
        'index_title' => 'DirectBosses List',
        'new_title' => 'New Direct boss',
        'create_title' => 'Create DirectBoss',
        'edit_title' => 'Edit DirectBoss',
        'show_title' => 'Show DirectBoss',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'employee_number' => 'Employee Number',
            'phone' => 'Phone',
            'position_id' => 'Position',
        ],
    ],

    'employees' => [
        'name' => 'Employees',
        'index_title' => 'Employees List',
        'new_title' => 'New Employee',
        'create_title' => 'Create Employee',
        'edit_title' => 'Edit Employee',
        'show_title' => 'Show Employee',
        'inputs' => [
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'employee_number' => 'Employee Number',
            'position_id' => 'Position',
            'direct_boss_id' => 'Direct Boss',
        ],
    ],

    'supervisor_committees' => [
        'name' => 'Supervisor Committees',
        'index_title' => 'SupervisorCommittees List',
        'new_title' => 'New Supervisor committee',
        'create_title' => 'Create SupervisorCommittee',
        'edit_title' => 'Edit SupervisorCommittee',
        'show_title' => 'Show SupervisorCommittee',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'employee_number' => 'Employee Number',
            'phone' => 'Phone',
        ],
    ],

    'technical_committees' => [
        'name' => 'Technical Committees',
        'index_title' => 'TechnicalCommittees List',
        'new_title' => 'New Technical committee',
        'create_title' => 'Create TechnicalCommittee',
        'edit_title' => 'Edit TechnicalCommittee',
        'show_title' => 'Show TechnicalCommittee',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'employee_number' => 'Employee Number',
            'phone' => 'Phone',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
