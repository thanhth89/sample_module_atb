<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);
$db = require(__DIR__ . '/../../common/config/db.php');
$components = require(__DIR__ . '/../../common/config/components.php');

return array_replace_recursive(
    require(__DIR__ . '/../../common/config/main.php'),
    [
        'id' => 'app-api',
        'vendorPath' => dirname(__DIR__) . '/../vendor',
        'basePath' => dirname(__DIR__),
        'language' => 'en',
        'sourceLanguage' => 'en',
        'defaultRoute' => 'default',
        'controllerNamespace' => 'api\controllers',
        'components' => array_merge($components, [
            'db' => $db,
            'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'suffix' => '',
                'rules' => [
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    'module/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                    'debug/<controller>/<action>' => 'debug/<controller>/<action>',
                ]
            ],
            'errorHandler' => [
                'errorAction' => 'default/error'
            ],
        ]),
        'params' => $params
    ]
);