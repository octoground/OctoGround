<?php

use yii\helpers\Url;

if ($linked) {
    $name = $field->name . '[]';
} else {
    $name = $field->name;
}
$rand = rand();
?>

<div class="row">
    <label title="Загрузить новое изображение" for="imgInp-<?= $rand ?>">
        <?= $form->field($model, $name)->hiddenInput(['value' => $model[$field->name]])->label(false) ?>
        <input type="file" accept="image/*" name="file" class="hide imgInp" id="imgInp-<?= $rand ?>" data-upload-url="<?= Url::to(['/tools/upload-image']) ?>">
        Загрузить изображение (<?= $field->alias; ?>)

        <div class="edit_image_load">
            <div class="edit_image_load_field">
                <?php
                if ($model[$field->name]) {
                    echo "<img src='" . $model[$field->name] . "' class='blah'></img>";
                } else {
                    echo "<i class='fa fa-plus-circle' aria-hidden='true'></i>";
                }
                ?>
            </div>
        </div>
    </label>
</div>