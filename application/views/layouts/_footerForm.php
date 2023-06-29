<?php

use app\models\AppForm;
use yii\bootstrap\ActiveForm;

$connectForm = new AppForm();

$form = ActiveForm::begin([
    'action' => '/site/connect',
    'fieldConfig' => [
        'template' => "{input}{label}",
        'labelOptions' => ['class' => 'placeholder transition3s'],
        'inputOptions' => ['class' => 'transition3s'],
        'wrapperOptions' => ['class' => 'transition3s'],
        'options' => [
            'class' => 'brief_input'
        ]
    ],

]);
?>

<div class="grid indent">
    <div class="left">
        <!-- <div class="brief_input"> -->
        <?= $form->field($connectForm, 'name')->textInput(['placeholder' => ' ']); ?>
        <!-- </div> -->
    </div>
    <div class="right">
        <!-- <div class="brief_input"> -->
        <?= $form->field($connectForm, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7 (999) 999 99 99',
            'options' => ['placeholder' => ' '],
            'clientOptions' => [
                'showMaskOnHover' => false
            ]
        ]); ?>
        <!-- </div> -->
    </div>
</div>


<?= $form->field($connectForm, 'text')->textarea(["maxlength" => "330", "rows" => '7', 'placeholder' => ' ']); ?>
<?= $form->field($connectForm, 'type')->hiddenInput()->label(false); ?>

<button type="submit" class="btn flex"><span class="flex"></span>
    <p class="transition3s">Отправить</p>
</button>

<?php ActiveForm::end(); ?>