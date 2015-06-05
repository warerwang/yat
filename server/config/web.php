<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-cn',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'x-P22tKADLNJiv0qfwILGjMAHSxBiBOd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
//            'loginUrl' => ['admin/default/sign-in']
        ],
//        'errorHandler' => [
//            'errorAction' => 'admin/default/error',
//        ],
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
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                [
                    'class' => \yii\rest\UrlRule::className(),
                    'controller'    => ['category' => 'category', 'article' => 'article', 'user' => 'user'],
                    'extraPatterns' => [
                        'GET {email}'       => 'get-email',
                        'GET current'       => 'current',
                        'GET {id}/articles' => 'list',
                    ],
                    'tokens' => [
                        '{id}'      => '<id:\d+>',
                        '{email}'   => '<email:.+@.+>'
                    ]
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                /** @var yii\web\Response $response */
                $response = $event->sender;
                if(!$response->isSuccessful && is_array($response->data) && isset($response->data['type'])){
                     unset($response->data['type']);
                }
            },
        ],

    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\admin',
        ]
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
