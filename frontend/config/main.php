<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
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
            'rules' => [
                'c/<cat_alias:.*?>' => 'product/view-category',
                'tat-ca-san-pham.html' => 'product',
                'p/?' => 'product',
                'p/<p_alias:.*?>.html' => 'product/view',
                'n/<alias:.*?>.html' => 'news/view',
                'n/?' => 'news',
                'checkout.html' => 'ajax-cart/checkout',
                'lien-he.html' => 'info/contact',
                'gioi-thieu.html' => 'info/introduce'
            ]
        ]
    ],
    'params' => $params,
];
