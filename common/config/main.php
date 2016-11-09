<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'advancedUpload' => [
            'class' => 'common\components\advancedUpload\AdvancedUpload',
        ],
    ],
];
