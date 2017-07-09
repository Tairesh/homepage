<?php

$params = require(__DIR__ . '/params.php');
$secret = require(__DIR__ . '/secret.php');

$config = [
    'id' => 'homepage',
    'name' => 'Илья Агафонов',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => $secret['cookieValidationKey'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/about' => '/site/about',
                '/contact' => '/site/contact',
                '/login' => '/site/login',
                '/logout' => '/site/logout',
                '/edit' => '/site/edit',
//                '/p/<url:.+>' => '/post/view',
//                '/' => '/site/index',
//                '/<page:\d+>' => '/site/index',
                
                [
                    'class' => 'app\components\BlogUrlRule',
                ],
            ],
        ],
	'tagLoader' => [
	    'class' => 'app\components\TagLoader',
	],
        
    ],
    'params' => array_merge($params, $secret),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
//	'allowedIPs' => ['*'],
    ];
}

return $config;
