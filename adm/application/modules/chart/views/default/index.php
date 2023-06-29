<?php
app\assets\SiteAsset::register($this);

use yii\helpers\Url;
$this->title = 'Создание графика';
?>
<div class="row">
    <div class="col-lg-12 edit_index">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
        <div>
            <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="btn btn-warning">Назад</a>
        </div>
    </div>
</div>
<div class="">
    <div></div>
    <div></div>
</div>