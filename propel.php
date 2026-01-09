<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'cocktails' => [
                    'adapter' => 'sqlite',
                    'dsn' => 'sqlite:db/cocktails.sq3',
                    'user' => 'amadare',
                    'password' => 'amadare',
                    'settings' => [
                        'charset' => 'utf8'
                    ]
                ]
            ]
        ]
    ]
];
