<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=cyrillic,cyrillic-ext',
        'css/jquery-ui.min.css',
        'css/font-awesome.min.css',
        'css/animate.css',
        'css/swiper.min.css',
        'css/lightbox.min.css',
        'plugins/gritter/css/jquery.gritter.css',
        'css/style.css'
    ];
    public $js = [
        'js/jquery-ui.min.js',
        'plugins/gritter/js/jquery.gritter.js',
        'js/swiper.min.js',
        'js/lightbox.min.js',
        'js/js.cookie.js',
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
    ];
}
