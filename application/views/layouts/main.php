<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="shortcut icon" href="<?= yii::getAlias('@web') ?>/images/default/favicon.ico" type="image/png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->head() ?>



<body>
    <?php $this->beginBody() ?>

    <?= $this->render('menu') ?>

    <div id="container">
        <?= $content ?>
    </div>
    <?= $this->render('footer') ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>