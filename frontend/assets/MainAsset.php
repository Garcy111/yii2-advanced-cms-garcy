<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/styles/fonts.css',
        'public/styles/main.css',
        'public/styles/media.css',
    ];
    public $js = [
        'public/js/main.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'app\assets\GridbootstrapAsset',
    ];
}