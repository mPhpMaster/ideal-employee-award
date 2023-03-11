<?php

use App\Interfaces\IRole;

return [
    'plural' => 'مجموعات الصلاحيات',
    'singular' => 'مجموعة الصلاحيات',
    'fields' => [
        'name' => 'اسم',
        'guard_name' => 'اسم الحارس',
        'permissions' => 'الصلاحيات',
        'users' => 'المستخدمين',

        IRole::AdminRole => 'مدير',
        IRole::SupervisorRole => 'مشرف',
        IRole::ForemanRole => 'مراقب',
        IRole::EmployeeRole => 'موظف',
    ],
    // 'import' => 'استيراد مجموعات الصلاحيات',
];
