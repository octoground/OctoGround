<?php

/* @var $this yii\web\View */

/** @var \app\modules\install\models\Settings $setting */
\app\assets\SiteAsset::register($this);

$this->title = 'Основные настройки';
?>

<div class="install">

    <div class="install_main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?= $this->title; ?>
                </h1>
            </div>
        </div>
        <div class="install_main_body">
            <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
            <div class="col-lg-6">
                <?= $form->field($setting, 'domain')->textInput(); ?>
                <?= $form->field($setting, 'db_driver_name')->dropDownList(['mysql' => 'MySQL', 'pgsql' => 'Postgre SQL']); ?>
                <?= $form->field($setting, 'db_host')->textInput(); ?>
                <?= $form->field($setting, 'db_name')->textInput(); ?>
                <?= $form->field($setting, 'db_username')->textInput(); ?>
                <?= $form->field($setting, 'db_password')->passwordInput(); ?>
            </div>
            <button type="submit" class="btn btn-default">Сохранить</button>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
    <div class="install_sity">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Настройки сайта
                </h1>
            </div>
        </div>
        <div class="install_sity_body">
            <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
            <div class="col-lg-6">
                <?= $form->field($setting, 'domain')->textInput(); ?>
                <?= $form->field($setting, 'db_driver_name')->dropDownList(['mysql' => 'MySQL', 'pgsql' => 'Postgre SQL']); ?>
                <?= $form->field($setting, 'db_host')->textInput(); ?>
                <?= $form->field($setting, 'db_name')->textInput(); ?>
                <?= $form->field($setting, 'db_username')->textInput(); ?>
                <?= $form->field($setting, 'db_password')->passwordInput(); ?>
            </div>
            <button type="submit" class="btn btn-default">Сохранить</button>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>