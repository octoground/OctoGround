<?php
use app\assets\FormAsset;
use app\assets\EditAsset;


FormAsset::register($this);
EditAsset::register($this);
$this->title = 'Редактирование';
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
])?>



