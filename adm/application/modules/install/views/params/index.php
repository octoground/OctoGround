<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    
    \app\assets\SiteAsset::register($this);
?>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'fromEmail')->textInput() ?>
    <?= $form->field($model, 'emailPass')->textInput() ?>
    <?= $form->field($model, 'hostMailer')->textInput() ?>
    <?= $form->field($model, 'portMailer')->textInput() ?>
    <?= $form->field($model, 'encryptionMailer')->textInput() ?>
    <?= $form->field($model, 'useFileTransport')->dropDownList([
        'true' => 'Да',
        'false' => 'Нет'
    ]) ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
