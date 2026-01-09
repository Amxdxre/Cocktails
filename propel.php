<?php

return [
    'propel' => [
        'paths' => [
            'phpDir' => __DIR__ . '/generated-classes',
            'sqlDir' => __DIR__ . '/generated-sql',
            'schemaDir' => __DIR__ . '/db',
        ],
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
        ],
        'generator' => [
            'defaultConnection' => 'cocktails',
            'connections'       => ['cocktails'],
        ],
        'runtime' => [
            'defaultConnection' => 'cocktails',
            'connections'       => ['cocktails'],
        ]
    ]
];
