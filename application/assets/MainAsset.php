<?php

namespace app\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        // 'css/style.css'
    ];

    public $js = [
        'js/autosize.js',
        'js/gsap.js',
        'js/main.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
