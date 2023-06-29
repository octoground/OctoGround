<?php

/** @var \yii\widgets\ActiveForm $form */
/** @var \app\models\Field $field */
/** @var string $image_link */
/** @var \yii\web\View $this */
/** @var \app\modules\edit\models\DynamicModel $model */
/** @var \app\models\ImageCropperSettings $settingsCropper */

use yii\helpers\Url;
?>
<div class="row">
    <div class="col-lg-12">
        <label title="Загрузить новое изображение" for="image-uploader-<?= $field->name?>" class="btn btn-md btn-success">
            <input type="file" accept="image/*" name="file" id="image-uploader-<?= $field->name?>" class="hide cropper-uploader-image"
                   data-upload-url="<?= Url::to(['/tools/crop']) ?>"
                   data-preview="#image-holder-<?= $field->name;?>"
                   data-link-input="#link-holder-<?= $field->name;?>"
                   data-cropper-modal="#cropper-modal-<?= $field->name;?>"
                   data-image-crop="#imageCrop-<?= $field->name;?>"
                   data-image-preview="#imagePreview-<?= $field->name;?>"
                   data-save-image="#saveImage-<?= $field->name;?>"
                   data-path="<?= $settingsCropper->path_name; ?>"
                   data-width="<?= $settingsCropper->width; ?>"
                   data-height="<?= $settingsCropper->height; ?>"
            >
            Загрузить изображение (<?= $field->alias; ?>)
        </label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <img style="max-width:200px; max-height:200px" id="image-holder-<?= $field->name;?>" src="<?php echo \Yii::$app->urlManager->hostInfo . $model->{$field->name}; ?>">
        <?php echo $form->field($model, $field->name)->hiddenInput(['id' => 'link-holder-' . $field->name])->label(false); ?>
    </div>
</div>
<div id="cropper-modal-<?= $field->name;?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Изменение области изображения</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="modal-preview" style="width: 100%;">
                                <img id="imageCrop-<?= $field->name;?>" src="" alt="Picture" style=" max-width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Предпросмотр
                            <div id="imagePreview-<?= $field->name;?>" class="img-preview"
                                 style="height:150px; overflow: hidden;text-align: center;width: 100%; "></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="saveImage-<?= $field->name;?>">Обрезать</button>
                </div>
            </div>
        </div>
    </div>
</div>


