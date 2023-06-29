<?php

/* @var $this yii\web\View */
/** @var \app\models\Table $table */
/** @var \app\modules\edit\models\DynamicModel $model */
/** @var \app\models\ImageCropperSettings $settingsCropper */
use app\assets\FormAsset;
use yii\helpers\Url;
// app\assets\SiteAsset::register($this);
FormAsset::register($this);

/** @var \app\models\Settings $setting */
/** @var \app\models\Field[] $fields */	
$this->title = 'Редкатирование';
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
    'table' => $table,
    'settingsCropper' => $settingsCropper,
    'id' => $table->id,
    'row_id' => $row_id,
    'is_row' => $is_row,
    'parent_row' => $parent_row,
    'parent_table' => $parent_table,
])?>
