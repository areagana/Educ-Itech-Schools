<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'c,r,u,d',
            'assignment'=>'c,r,u,d',
            'grade'=>'c,r,u,d',
            'course'=>'c,r,u,d',
            'file'=>'c,r,u,d',
            'term'=>'c,r,u,d',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'assignment'=>'c,r,u,d',
            'grade'=>'c,r,u,d',
            'course'=>'c,r,u,d',
            'file'=>'c,r,u,d'
        ],
        'ict-admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'assignment'=>'c,r,u,d',
            'grade'=>'c,r,u,d',
            'course'=>'c,r,u,d',
            'file'=>'c,r,u,d'
        ],
        'user' => [
            'profile' => 'r,u',
        ],
        'teacher' => [
            'profile' => 'r,u',
            'assignment'=>'c,r,u,d',
            'grade'=>'c,r,u,d',
            'course'=>'r',
            'file'=>'c,r,u,d',
        ],
        'student' => [
            'profile' => 'r,u',
            'assignment'=>'r',
            'grade'=>'r',
            'course'=>'r',
            'file'=>'r',
        ],
        'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
