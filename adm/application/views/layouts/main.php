<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="loader">
        <div class="pilsing">
            <div></div>
            <div></div>
        </div>
    </div>

    <?= $this->render('menu') ?>

    <div id="page-wrapper" style="<?= Yii::$app->controller->action->id === 'index' ? 'width: auto;' : '' ?>">

        <!-- <div class="container-fluid"> -->
            <?= $content ?>
        <!-- </div> -->
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
