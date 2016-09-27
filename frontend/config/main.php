<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'defaultRoute' => 'main/default/index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'main' => [
            'class' => 'frontend\modules\main\Module',
        ],
        'blog' => [
            'class' => 'frontend\modules\blog\Module',
        ],
        'shop' => [
            'class' => 'frontend\modules\shop\Module',
        ],
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => '/main/default/index',
                // '<_a:error>' => 'main/default/<_a>',
                'activation/<id>/<hash>' => 'user/default/activation',
                'user' => 'user/default',
                '<_a:(login|logout|reg|recovery)>' => 'user/default/<_a>',
                '<_a:(update)>' => 'user/profile/<_a>',
                'profile' => 'user/profile',
                'login/<service:google|facebook|etc>' => 'user/default/login',
                // module blog
                'blog/category/<ctg>' => '/blog/default/index',
                'blog/tag/<tag>' => '/blog/default/index',
                'blog/page/<page>' => '/blog/default/index',
                'blog/<link>' => '/blog/pages/index',
                'blog/article/<link>' => '/blog/default/post',
                // module shop
                'shop' => 'shop/default/index',
                'shop/<_a(cart)>' => 'shop/default/<_a>',
            ],
        ],
        
    ],
    'params' => $params,
];
