<?php

/* @var $this yii\web\View */
use app\models\ImageCropperSettings;
use yii\helpers\Url;

/** @var \app\models\ImageCropperSettings $relation */
// \app\assets\SiteAsset::register($this);
\app\assets\FormAsset::register($this);
$this->title = 'Настройки';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>
<a href="<?= Url::to(['index']); ?>" class="btn btn-success">Назад</a>

<div class="row">
    <div class="col-lg-12">
        <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
        <?= $form->field($relation, 'table_id')->dropDownList(['' => 'Выберите таблицу'] + ImageCropperSettings::getAllTables(), ['class' => 'get-fields form-control table_list', 'data-dependent-selector' => '.source_table_field']); ?>
        <div class="column_list"><?= $form->field($relation, 'title_column')->dropDownList(['' => 'Выберите таблицу'] + ImageCropperSettings::getColumns($relation->table_id), ['class' => 'get-fields form-control table_list', 'data-dependent-selector' => '.source_table_field']); ?></div>
        <?= $form->field($relation, 'width')->textInput(); ?>
        <?= $form->field($relation, 'height')->textInput(); ?>
        <?= $form->field($relation, 'path_name')->textInput(); ?>

        <button type="submit" class="btn btn-default">Сохранить</button>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</div>



