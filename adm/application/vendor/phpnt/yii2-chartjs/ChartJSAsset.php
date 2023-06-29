<?php
/**
 * Created by PhpStorm.
 * User: phpNT - http://phpnt.com
 * Date: 27.04.2017
 * Time: 7:59
 */

namespace phpnt\chartJS;

use yii\web\AssetBundle;

class ChartJSAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@bower/chart.js';

    /**
     * @inherit
     */
    public $css = [

    ];

    /**
     * @inherit
     */
    public $js = [
        // 'dist/Chart.js'
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js'
    ];

    public function init()
    {
        parent::init();
    }
}