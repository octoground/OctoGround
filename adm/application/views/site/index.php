<?php


/* @var $this yii\web\View */
\app\assets\SiteAsset::register($this);
\app\assets\ChartAsset::register($this);

use yii\helpers\Url;
use phpnt\chartJS\ChartJs;

$this->title = 'Dashboard';

?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-12 edit_index">
            <h1 class="page-header">
                Добро пожаловать!
            </h1>
            <div>
                <?php if (\Yii::$app->user->identity->is_admin) : ?>
                    <a href="#" class="btn btn-success">Настройки</a>
                    <a href="<?= Url::to(['chart/main/index']) ?>" class="btn btn-warning">Создать</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    // вывод графиков
    echo ChartJs::widget([
        'type'  => ChartJs::TYPE_LINE,
        'data'  => $chart->dataLine,
        'width' => '80%',
        'maxY' => 10,
        'legendPosition' => 'left'
    ]);

    ?>
</div>