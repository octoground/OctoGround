<?php

namespace app\assets;

use yii\web\AssetBundle;

class ContactAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/contact.css'
    ];

    public $js = [
        'js/portfolio/fm.revealator.jquery.min.js',
        // 'css/common.js',
        'js/gsap.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
