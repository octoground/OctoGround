<?php
/** @var integer $table_id */
/** @var \app\models\ImageCropperSettings $imageCropper */
use app\models\ImageCropperSettings;
use yii\helpers\Html;
\app\assets\SiteAsset::register($this);
?>
<div class="form-group field-imagecroppersettings-title_column required has-success">
    <label class="control-label" for="imagecroppersettings-title_column">Название колонки</label>
    <select id="imagecroppersettings-title_column" class="get-fields form-control" name="ImageCropperSettings[title_column]" data-dependent-selector=".source_table_field">
        <option value="">Выберите таблицу</option>
        <?php foreach (ImageCropperSettings::getColumns($table_id) as $name => $columns) :?>
            <option value="<?= $name; ?>"><?= $columns; ?></option>
        <?php endforeach; ?>
    </select>
    <div class="help-block"></div>
</div>