<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/nucleo/css/nucleo.css',
        'vendor/@fortawesome/fontawesome-free/css/all.min.css',
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'css/argon.css',
        'css/custom.css',
    ];
    public $js = [
        'vendor/jquery.scrollbar/jquery.scrollbar.min.js',
        'vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js',
        'vendor/js-cookie/js.cookie.js',
        'js/argon.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
