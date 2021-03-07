<?php
    define('L1','');
    define('L2','../');
    define('L3','../../');
    define('_DIR_', [
        'COMPONENTS' => [
            'ADMINS' => L2.'components/admins/',
            'USERS' => L1.'components/users/',
        ],
        'IMG' =>  [
            'ADMINS' => L2.'img/img-admin/',
            'USERS' => L1.'img/img-user/',
        ],
        'JS' =>  [
            'ADMINS' => L2.'js/',
            'USERS' => L1.'js/'
        ],
        'PAGES' => [
            'ADMINS' => L1.'pages/admin/',
            'USERS' => L1.'pages/user/',
        ],
        'LIB' => [
            'ADMINS' => L2.'lib/',
            'USERS' => L1.'lib/',
        ],
        'VENDOR' => L1.'vendor/',
        'VIDEO' => [
            'ADMINS' => L2.'video/',
            'USERS' => L1.'video/',
        ],
        'CSS' => [
            'ADMINS' => L2.'css/',
            'USERS' => L1.'css/',
        ],
        'FONT' => [
            'ADMINS' => L2.'fonts/',
            'USERS' => L1.'fonts/',
        ],
        'PLUGINS' => [
            'ADMINS' => L2.'plugins/',
            'USERS' => L1.'plugins/', 
        ],
    ]);
     
?>