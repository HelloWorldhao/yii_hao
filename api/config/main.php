<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'language'=>'zh-CN',
    'modules'=>[
        'v1'=>[
            'class'=>'api\modules\v1\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers'=>[
                'application/json'=>'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => true,
            'enableSession'=>false,
            // 'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
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
            'enableStrictParsing'=>true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>['v1/goods','v1/user'],
                ],
                'POST v1/users/search/<id>'=>'v1/user/search',

//                'DELETE /users/<id>'=>'/users/delete',
//                'PUT,PATCH /users/<id>' => '/user/update',
//                'GET,HEAD /users/<id>' => '/user/view',
//                'POST /users' => '/user/create',
//                'GET,HEAD /users' => '/user/index',

//                'PUT,PATCH <module>/users/<id>' => '<module>/user/update',
//                'DELETE <module>/users/<id>' => '<module>/user/delete',
//                'GET,HEAD <module>/users/<id>' => '<module>/user/view',
//                'POST <module>/users' => '<module>/user/create',
//                'GET,HEAD <module>/users' => '<module>/user/index',
//                'GET <Module>/users/search/<id>'=>'<Module>/users/search',
            ],
        ],
        //restful 自定义错误响应
//        'response' => [
//            'class' => 'yii\web\Response',
//            'on beforeSend' => function ($event) {
//                $response = $event->sender;
//                if ($response->data !== null && !empty(Yii::$app->request->get('suppress_response_code'))) {
//                    $response->data = [
//                        'success' => $response->isSuccessful,
//                        'data' => $response->data,
//                    ];
//                    $response->statusCode = 200;
//                }
//            },
//        ],
    ],
    'params' => $params,
];
