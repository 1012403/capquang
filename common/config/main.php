<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'timeZone' => 'Asia/Ho_Chi_Minh'
        ]
    ],
    'controllerMap' => [
        'ckeditor' => [
            'class' => 'common\components\CkEditorController',
        ],
        'ajax-cart' => [
            'class' => 'common\components\AjaxCartController',
        ],
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>'/upload',
                'basePath'=>'@uploadPath',
                'path' => 'images',
                'name' => 'Upload Images'
            ],
//            'watermark' => [
//                'source'         => __DIR__.'/logo.png', // Path to Water mark image
//                 'marginRight'    => 5,          // Margin right pixel
//                 'marginBottom'   => 5,          // Margin bottom pixel
//                 'quality'        => 95,         // JPEG image save quality
//                 'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//                 'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//                 'targetMinPixel' => 200         // Target image minimum pixel size
//            ]
        ]
    ],
    'modules' => [
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module'
        ]
    ],
    'language' => 'vi',
];
