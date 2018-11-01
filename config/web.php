<?php

return [
    'id' => 'sbt24',
    'basePath' => realpath(__DIR__.'/../'),
    'name'=>'СПЕЦБАНКТЕХНИКА',
    'language' => 'ru-RU',
    'bootstrap' => [
        'debug',
        'gii'
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [ // правила формирования ссылок
                    '' => 'site/index',
                    
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<action>' => 'site/<action>',
                    //'category' => 'category/index',
                    'category/<id:\d+>' => '/category-view',
                
                    /*'<module:cabinet>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                    '<module:cabinet>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                    '<module:cabinet>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',*/
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'gq6Alod93xz9Sm69Qlg7E',
            'baseUrl' => '/sbt24'    // убрать web из url, на хостинге - ''
        ],
        'db' => require(__DIR__.'/db.php'),
        'user' => [ // подключаем текущую логику аутентификации
                //'identityClass' => 'app\models\SignupForm',
                'identityClass' => 'app\models\Users',
                'enableAutoLogin' => true,
            ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'mailer' => [ // подключаем swiftmailer
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' => true, // send to file in runtime\mail
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.mail.ru',
                    'username' => 'mhause@mail.ru',
                    'password' => 'rexerov',
                    'port' => '465', // Port 25 is a very common port too
                    'encryption' => 'ssl', // It is often used, check your provider or mail server specs
                ],
            ],
    ],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'gii' => [  // настройки Gii
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
        /*'cabinet' => [
            'class' => 'app\modules\cabinet\Module',
        ]*/
    ],
    // подключить extensions.php для: Gii
    'extensions' => require(__DIR__.'/../vendor/yiisoft/extensions.php')
];

