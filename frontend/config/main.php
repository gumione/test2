<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=>'Example.com',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage' => 'en',
    'language' => 'en',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'options' => [
            'class' => 'common\components\Options'
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'cookieValidationKey' => 'B3574DVN37cwWMY-af9lbUUVHYAPiMmcvqd9YY6pfP1',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
        'BestlikerAPI' => [
            'class' => 'common\components\BestlikerAPI'
        ],        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'payment-success' => 'site/payment-success',
                'payment-error' => 'site/payment-error',
                '<controller:\w+>/<action:\w+>/<service_group:\w+>' => '<controller>/<action>'
            ],
        ],
        'options' => [
            'class' => 'common\components\Options'
        ],
        'PayPalRestApi'=>[
            'class'=>'frontend\components\PayPalRestApi',
            'redirectUrl'=>'/site/make-payment', // Redirect Url after payment
            ]
        
    ],
    'params' => $params,
];
