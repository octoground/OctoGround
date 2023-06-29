<?php

/* @var $this yii\web\View */

/** @var \yii\base\DynamicModel $model */
/** @var \app\models\Table $table */
/** @var \app\models\ImageCropperSettings $settingsCropper */

use app\assets\FormAsset;
use yii\helpers\Url;

FormAsset::register($this);

/** @var \app\models\Settings $setting */
/** @var \app\models\Field[] $fields */


$this->title = 'Добавление записи';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
    'fields' => $fields,
    'settingsCropper' => $settingsCropper,
    'logicModel' => $logicModel
]) ?>