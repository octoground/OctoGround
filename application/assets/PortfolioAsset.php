<?php

namespace app\assets;

use yii\web\AssetBundle;

class PortfolioAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/portfolio.css',
    ];

    public $js = [
        'js/portfolio/fm.revealator.jquery.min.js',
        'js/portfolio/portfolio.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
