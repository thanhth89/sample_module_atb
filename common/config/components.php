<?php
return [
    'gearman' => [
        'class' => 'shakura\yii2\gearman\GearmanComponent',
        'servers' => [
            ['host' => '127.0.0.1', 'port' => 4730],
        ],
        'user' => 'developer',
    ],
];
