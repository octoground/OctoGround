<?php

    use yii\helpers\Url;

    if($row){
        $name = $field->name . '[]';
    }else{
        $name = $field->name;
    }
    $rand = rand();
?>

<div class="row">
    <div class="col-lg-12">
        <label title="Загрузить новое изображение" for="image-uploader-<?= $field->name . $rand ?>" class="">
            <?php echo $form->field($model, $name)->hiddenInput(['id' => 'link-holder-' . $field->name . $rand, 'value' => $model->{$field->name}])->label(false); ?>
            <input type="file" accept="image/*" name="file" id="image-uploader-<?= $field->name . $rand ?>" class="hide cropper-uploader-image"
                   data-upload-url="<?= Url::to(['/tools/crop']) ?>"
                   data-preview="#image-holder-<?= $field->name . $rand; ?>"
                   data-link-input="#link-holder-<?= $field->name . $rand; ?>"
                   data-cropper-modal="#cropper-modal-<?= $field->name;?>"
                   data-image-crop="#imageCrop-<?= $field->name;?>"
                   data-image-preview="#imagePreview-<?= $field->name;?>"
                   data-save-image="#saveImage-<?= $field->name;?>"
                   data-path="<?= $settingsCropper->path_name; ?>"
                   data-width="<?= $settingsCropper->width; ?>"
                   data-height="<?= $settingsCropper->height; ?>"
            >
            Загрузить изображение (<?= $field->alias; ?>)

            <div class="edit_image_load">
                <div class="edit_image_load_field">
                    <?php
                        if($model[$field->name]){
                            echo "<img id='image-holder-" . $field->name . $rand ."' src='" . \Yii::$app->urlManager->hostInfo . $model->{$field->name} . "'>";
                        }else{
                            echo "<i class='fa fa-plus-circle' aria-hidden='true'></i>";
                        }
                    ?>
                </div>
            </div>
        </label>
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


