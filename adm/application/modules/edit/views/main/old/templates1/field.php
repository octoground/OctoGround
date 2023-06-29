<?php
    use vova07\imperavi\Widget;
    use yii\helpers\Url;

    // if($row){
    //     $name =  $field->name . '[]';
    // }else{
    //     $name =  $field->name;
    // }
//     echo "<pre>";
    // var_dump($field); die;
// echo "</pre>";
    // var_dump($model['img']); die;

    $name = $row ? $field->name . '['.$sub_row_id.']' : $field->name;

    $value = $model[$field->name] ? $model[$field->name] : '';
?>
<div class="form-group">
    <?php switch ($field->type->name) {  
        default:
        case 'textInput':
            echo $form->field($model, $name)->textInput(['class' => 'form-control', 'value' => $value])->label($field->alias);
            break;
        case 'hiddenInput':
            echo $form->field($model, $name)->hiddenInput(['class' => 'form-control', 'value' => $value])->label(false);
            break;
        case 'textArea':
            $rand = rand();

            echo $form->field($model, $name)->textarea(['class' => '', 'id' => $rand, 'value' => $value])->label($field->alias);
            echo Widget::widget([
                'selector' => '#' . $rand,
                'plugins' => [
                    'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset', 
                    'filemanager' => 'vova07\imperavi\bundles\FileManagerAsset',    
                ],
            ]);
            break;
        case 'textAreaNoEditor':
            if($row){
                echo $form->field($model, $field->name.'[]')->textarea(['class' => 'form-control', 'rows' => 10, 'value' => $model[$field->name]])->label($field->alias);
            }else{
                echo $form->field($model, $field->name)->textarea(['class' => 'form-control', 'rows' => 10])->label($field->alias);
            }
            
            break;
        case 'uploadImage':
            echo $this->render('/main/templates/upload_image', [
                'field' => $field,
                'model' => $model,
                'form' => $form,
                'row' => $row
            ]);
            break;
        case 'imageCropper':
            echo $this->render('/main/templates/imageCropper', [
                'field' => $field,
                'model' => $model,
                'form' => $form,
                'settingsCropper' => $settingsCropper[$field->name],
                'row' => $row
            ]);
            break;
        case 'datetime':
            if($row){
                echo $form->field($model, $field->name . '[]')->textInput(['class' => 'form-control datetimepicker', "autocomplete" => "off", 'value' => $model[$field->name]])->label($field->alias);
            }else{
                echo $form->field($model, $field->name)->textInput(['class' => 'form-control datetimepicker'])->label($field->alias);
            }
            break;
        case 'date':
            if($row){
                echo $form->field($model, $field->name . '[]')->textInput(['class' => 'form-control  datepicker', "autocomplete" => "off", 'value' => $model[$field->name]])->label($field->alias);
            }else{
                echo $form->field($model, $field->name)->textInput(['class' => 'form-control  datepicker'])->label($field->alias);
            }
            break;
        case 'time':
            if($row){
                echo $form->field($model, $field->name . '[]')->textInput(['class' => 'form-control  timepicker', "autocomplete" => "off", 'value' => $model[$field->name]])->label($field->alias);
            }else{
                echo $form->field($model, $field->name)->textInput(['class' => 'form-control  timepicker'])->label($field->alias);
            }
            break;
        case 'boolean':
            if($row){
                echo $form->field($model, $field->name.'[]')->dropDownList([0 => 'Нет', 1 => 'Да'], 
                    [
                    'class' => 'form-control',
                    'options' => [
                        $model[$field->name] => ['selected' => true]] 
                    ])->label($field->alias);
            }else{
                echo $form->field($model, $field->name)->dropDownList([0 => 'Нет', 1 => 'Да'], ['class' => 'form-control'])->label($field->alias);
            }
            
            break;
        case 'dropDownList':
            if($row){
                echo $form->field($model, $field->name.'[]')->dropDownList($model->getRelationArray($field->name), 
                    [
                    'class' => 'form-control',
                    'options' => [
                        $model[$field->name] => ['selected' => true]] 
                    ])->label($field->alias);
            }else{
                echo $form->field($model, $field->name)->dropDownList($model->getRelationArray($field->name), ['class' => 'form-control'])->label($field->alias);
            }
           
            break;
    } ?>
</div>