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
    'bootstrap' => ['log'],'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
                'date' => 'd/m/Y',
                'time' => 'H:i:s A',
                'datetime' => 'd/m/Y H:i:s A',
            ],
            'saveSettings' => [
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],
            'autoWidget' => true,
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        ]
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
