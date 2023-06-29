<?php

namespace app\assets;

use yii\web\AssetBundle;

class BriefAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/brief.css'
    ];

    public $js = [];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
