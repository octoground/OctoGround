<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

\app\assets\BriefAsset::register($this);
$this->title = 'Заполните бриф';

$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->title]);
$this->registerMetaTag(['name' => 'og:url', 'content' =>  'https://octoground.ru/site/brief']);
$this->registerMetaTag(['name' => 'og:description', 'content' => 'Расскажите нам о своем проекте']);
$this->registerMetaTag(['name' => 'og:image', 'content' => Url::to(['/images/default/bg-octo.jpg'])]);

$this->registerMetaTag(
    ['name' => 'description', 'content' =>  'Создание и продвижение сайтов - Digital-agency OctoGround - создаем и продвигаем современные и продающие сайты. Звоните +7 (922) 777-45-46']
);
?>
<div class="brief">
    <div class="header">
        <p class="desktop">Заполните бриф</p>
        <h3>Расскажите нам о своем проекте</h3>
    </div>
    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="brief_content">

        <div class="brief_service indent indent_main">
            <p>Выберите услугу</p>

            <?= $form->field($brief, 'serviceList[]')
                ->checkboxList([
                    'site' => 'Разработка',
                    'marketing' => 'Маркетинг',
                    'maintenance' => 'Сопровождение',
                    'copyright' => 'Копирайт',
                    'other' => 'Другое',
                ], [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $id = str_replace(array('[', ']'), '', $name) . '_' . $index;
                        $result = '<div>' .
                            Html::checkbox($name, $checked, ['value' => $value, 'id' => $id]) .
                            Html::label($label, $id) .
                            '</div>';
                        return $result;
                    },
                    'class' => 'brief_service_container flex',
                ])->label(false); ?>

        </div>

        <?= $form->field($brief, 'activity', ['template' => "<p>Чем занимается ваша компания</p>{input}", 'options' => ['class' => 'brief_input indent']])->textInput(['placeholder' => "Например: Продажа меди и золота высшего качества"])->label(false); ?>

        <?= $form->field($brief, 'desc', ['template' => "<p>Опишите вашу задачу</p>{input}", 'options' => ['class' => 'brief_input indent']])->textarea(['placeholder' => "Например: Нужен офигенный корпоративный сайт", 'rows' => '10'])->label(false); ?>

        <?= $form->field($brief, 'competitor', ['template' => "<p>Ваши конкуренты</p>{input}", 'options' => ['class' => 'brief_input indent']])->textarea(['placeholder' => "Ссылки или названия конкурентов", 'rows' => '10'])->label(false); ?>


        <div class="brief_service indent">
            <p>Ваш бюджет</p>

            <?= $form->field($brief, 'budget', ['template' => "{input}"])
                ->radioList($brief->budgetList, [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $id = str_replace(array('[', ']'), '', $name) . '_' . $index;
                        $result = '<div>' .
                            Html::radio($name, $checked, ['value' => $value, 'id' => $id]) .
                            Html::label($label, $id) .
                            '</div>';
                        return $result;
                    },
                    'class' => 'brief_service_container flex',
                ])->label(false); ?>
        </div>
        <?= $form->field($brief, 'link', ['template' => "<p>Ссылка на ваш сайт (Если актуально)</p>{input}", 'options' => ['class' => 'brief_input indent']])->textInput(['placeholder' => "Например: https://site.ru"])->label(false); ?>

        <div class="brief_service indent">
            <p>Дополнительные услуги</p>

            <?= $form->field($brief, 'additionalList[]')
                ->checkboxList($brief->arrAdditional, [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $id = str_replace(array('[', ']'), '', $name) . '_' . $index;
                        $result = '<div>' .
                            Html::checkbox($name, $checked, ['value' => $value, 'id' => $id]) .
                            Html::label($label, $id) .
                            '</div>';
                        return $result;
                    },
                    'class' => 'brief_service_container flex',
                ])->label(false); ?>
        </div>

        <?= $form->field($brief, 'activity', ['template' => "<p>Дополнительные комментарии</p>{input}", 'options' => ['class' => 'brief_input indent']])->textarea(['placeholder' => "О чем нам еще нужно знать", 'rows' => '10'])->label(false); ?>


        <div class="brief_contact">
            <p>Ваши контакты</p>

            <div class="brief_contact_form">

                <?= $form->field($brief, 'fio', ['template' => "{input}{label}", 'options' => ['class' => 'brief_input'], 'labelOptions' => ['class' => 'transition3s']])->textInput(['placeholder' => ' ']); ?>


                <div class="grid indent">
                    <div class="left">
                        <?= $form->field($brief, 'email', ['template' => "{input}{label}", 'options' => ['class' => 'brief_input'], 'labelOptions' => ['class' => 'transition3s']])->textInput(['placeholder' => ' ']); ?>

                    </div>
                    <div class="right">
                        <?= $form->field($brief, 'phone', ['template' => "{input}{label}", 'options' => ['class' => 'brief_input'], 'labelOptions' => ['class' => 'transition3s']])->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7 (999) 999 99 99',
                            'options' => ['placeholder' => ' '],
                            'clientOptions' => [
                                'showMaskOnHover' => false
                            ]
                        ]); ?>

                    </div>
                </div>

                <button type="submit" class="btn flex"><span class="flex"></span>
                    <p class="transition3s">Отправить</p>
                </button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>