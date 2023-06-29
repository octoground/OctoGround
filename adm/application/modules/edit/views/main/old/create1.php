<?php

/* @var $this yii\web\View */

/** @var \yii\base\DynamicModel $model */
/** @var \app\models\Table $table */
/** @var \app\models\ImageCropperSettings $settingsCropper */

use app\assets\FormAsset;
use yii\helpers\Url;

// app\assets\SiteAsset::register($this);
FormAsset::register($this);

/** @var \app\models\Settings $setting */
/** @var \app\models\Field[] $fields */


$this->title = 'Добавление элемента';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Основная информация
        </h1>
    </div>
</div>
<?= $this->render('_form', [
    'model' => $model,
    'fields' => $fields,
    'table' => $tableModel,
    'settingsCropper' => $settingsCropper,
    'id' => $table,
    'is_row' => $is_row
]) ?>