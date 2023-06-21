<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'redisyii',
            'port' => 6379,
            'database' => 0,
        ],
        
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
    ];
    
    $config['bootstrap'][] = 'gii';
    //'class' => \yii\gii\Module::class,
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1', $_SERVER['REMOTE_ADDR'], '13.0.0.3'],
    ];
}

return $config;
