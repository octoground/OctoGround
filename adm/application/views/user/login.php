<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<main class="inPage">
    <div class="logo inPage-logo" style="background: -webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.5)),to(black)),url(<?= Url::to(['images/bg-octo.jpg']) ?> ) no-repeat;">
        <div class="welcom">
            <h1>octoground</h1>
            <p>project manager</p>
        </div>
    </div>    
    <div class="auth">
        <h2>Авторизация</h2>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            // 'enableAjaxValidation' => true,
            'fieldConfig' => [
                // 'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        <div class="inPageForm">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>
        </div>
        <div class="inPageForm">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

        <?= $form->field($model, 'rememberMe')->checkbox()->label('запомнить') ?>

        <?= Html::submitButton('войти', ['class' => 'btn btn-primary btn-block inPageBtn', 'tabindex' => '3']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</main>


<!-- <div class="inPage">

    <div class="inPage-block lkForm lkLogIn">
        <a href="/adm" class="inPage-logo"></a>
        <div class="inPageF">
            <div class="lkFormTop"><?= Html::encode($this->title) ?></div>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <div class="inPageForm">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="inPageForm">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <?= Html::submitButton('Вход', ['class' => 'btn btn-primary btn-block inPageBtn', 'tabindex' => '3']) ?>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 -->