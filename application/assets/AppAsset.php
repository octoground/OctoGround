<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css',
        'css/reset.css',
        'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css',
        'css/media.css',
        'css/style.css',
        'css/standart.css',
        'css/menu.css',
        'css/magnific-popup.css',
  
    ];

    public $js = [
        // 'js/device.js',
        'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/common.js',
        'js/media.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
