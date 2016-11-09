<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$configSecure = parse_ini_file('/var/secure/secure.ini', true);

return [
    'id' => 'app-frontend',
    'name' => 'SellBox Application',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'comments'],
    'modules' => [
        'comments' => [
            'class' => 'yeesoft\comments\Comments',
            'onlyRegistered' => true,
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => $configSecure['google_client_id'],
                    'clientSecret' => $configSecure['google_client_secret'],
                    'returnUrl' => 'http://blogext.com/site/auth?authclient=google'
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>' => 'article/category',
                '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
            ],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'defaultRoute' => 'article/index',
    'params' => $params,
];
