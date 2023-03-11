<?php

use App\Interfaces\IRole;

return [
    'singular' => $singular = 'مستخدم',
    'plural' => $plural = 'المستخدمين',
    'user' => $singular,
    'users' => $plural,
    'fields' => [
        'id' => 'م',
        'name' => 'الإسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'AVATAR' => 'الصورة',
        'phone_number' => 'رقم الجوال',
        'role' => 'المنصب',
        'projects' => 'المشاريع',
        'image' => 'الصورة الرمزية'
    ],
    'roles' => [
        IRole::AdminRole => 'مدير',
        IRole::SupervisorRole => 'مشرف',
        IRole::ForemanRole => 'مراقب',
        IRole::EmployeeRole => 'موظف',
    ]
];
