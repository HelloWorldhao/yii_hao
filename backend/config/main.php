<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'language'=>'zh-CN',
    'modules'=>[
        'admin'=>[
            'class'=>'mdm\admin\Module',
        ],
        'migration'=>[
            'class'=>'migration\Module'
        ],
        'gii' => [
            'class' => 'gii\Module',
            'generators' => [
                'crud' => [
                    'class' => 'yii\gii\generators\crud\Generator',
                    'enableI18N' => true,
                    'templates' => [
                        'default' => '@gii/generators/crud/default'
                    ]
                ],
                'model' => [
                    'class' => 'gii\\generators\model\\Generator',
                    'enableI18N' => true,
                    'useTablePrefix' => true,
                    'ns' => 'common\\models'
                ]
            ]
        ],
        'debug'=>[
            'class'=>'debug\Module',
        ],
    ],
    'aliases'=>[
        '@mdm\admin'=>'@vendor/mdmsoft/yii2-admin',
        '@migration'=> '@backend/modules/migration',
        '@gii' => '@backend/modules/gii',
    ],
    'as access'=>[
        'class'=>'mdm\admin\components\AccessControl',
        'allowActions'=>[
//            '*',
            'site/*'
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            ],
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'defaultRoles'=>['guest'],
        ],
    ],
    'params' => $params,
];
