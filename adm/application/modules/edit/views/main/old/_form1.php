<?php

use yii\helpers\Url;
use vova07\imperavi\Widget;
use app\modules\edit\models\DynamicModel;
use app\modules\edit\models\Field;
use app\modules\edit\models\Gallery;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>

<?php $form = \yii\widgets\ActiveForm::begin(); ?>
<div class="row edit_row" style="margin-bottom: 0">
    <div class="col-lg-12">
        <div class="edit_setting_board">
            <div class="edit_content">
                <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Url::to(['index', 'id' => $id]); ?>" class="btn btn-success">Назад</a>
                <?php if (\Yii::$app->user->identity->is_admin) : ?>
                    <a href="<?= Url::to(['/install/table/field', 'table_id' => $id]) ?>" target="_blank" class="btn btn-success">Настройки таблицы</a>
                <?php endif; ?>
                <?php if (\Yii::$app->user->identity->is_admin && $model->table->linked) : ?>
                    <?php $table_id = new DynamicModel([], ['table' => $model->table->linked->table]); ?>
                    <a href="<?= Url::to(['/install/table/field', 'table_id' => $table_id->table->id]) ?>" target="_blank" class="btn btn-success">Настройки связной таблицы</a>
                <?php endif; ?>
                <a href="#" type="" class="btn btn-default edit_update_not_exit" data-row-id="<?= $row_id ?>" data-page="<?= Yii::$app->controller->action->id ?>" data-table-id="<?= $id ?>" data-is-row="<?= $is_row ? $is_row : Yii::$app->getRequest()->getQueryParam('is_row') ?>" data-parent-table-id="<?= $parent_table ? $parent_table : Yii::$app->getRequest()->getQueryParam('parent_table_id') ?>" data-parent-row-id="<?= $parent_row ? $parent_row : Yii::$app->getRequest()->getQueryParam('parent_row_id') ?>" data-id-row="<?= $row_id ?>" data-id="">Сохранить</a>
                <button type="submit" class="btn btn-default">Сохранить и выйти</button>
            </div>
        </div>

        <?php foreach ($fields as $field) : ?>
            <?= $this->render('templates/field', compact('field', 'model', 'form', 'settingsCropper')) ?>
        <?php endforeach; ?>
    </div>
</div>

<?php
// if(Yii::$app->controller->action->id !== 'create'){
echo $this->render('gallery', ['table' => $table, 'row_id' => $row_id, 'row' => false]);  //Вывод галереи

if ($model->table->linked) { //Определяем существование связной таблицы
    $item = $model->table;
    $header = $item->linked->header_linked_table;
    // var_dump($item);
    if ($item->linked->type_view == '1' || $item->linkedPages->type_view) { //на одной странице
        $fields = $item->field;
        $table_name = $item->linkedPages->table; //наименнование связной таблицы
        $table_edit_id = $model->id ? $model->id : false;
        $model = new DynamicModel([], ['table' => $table_name]);
        //ВЫВОД
        
        echo "<div class='linked_header'><h1>" . $header . "</h1></div>";

        if (Yii::$app->controller->action->id === 'edit' || Yii::$app->controller->action->id === 'double') {
            $data = $model->loadFromDBLinked($table_edit_id, $item->linkedPages->name_linked_table_field, $item->linkedPages->name_linked_table);
            $data_count = count($data);
            $fields = Field::find()->where(['table_id' => $table_name->id, 'is_editable' => true])->asArray()->all();
            $fields = ArrayHelper::map($fields, 'name', 'name');
            $fields_coutn = count($fields);
            $fields_key = array_keys($fields);

            // var_dump($fields);
            
            if ($data[0]) {
                // $model->modelSave($model, $row_id);
                $fields = array_intersect_key($data[0], $fields);
                for ($i = 0; $i < $data_count; $i++) {
                    for ($j = 0; $j < $fields_coutn; $j++) {

                        $model[$fields_key[$j]] = $data[$i][$fields_key[$j]];
                    }

                    echo $this->render('templates/row', [
                        // 'fields' => $item->field,
                        'fields' => Field::find()->where(['table_id' => $table_name->id, 'is_editable' => true])->all(),
                        'form' => $form,
                        'model' => $model,
                        'row' => true,
                        'table_name' => $table_name,
                        'sub_row_id' => $data[$i]['id'],
                        'settingsCropper' => $settingsCropper
                    ]);
                }
            } else {
                $model[$item->linkedPages->name_linked_table_field] = $row_id;
                $model->insert();
                $sub_row_id = Yii::$app->dbFrontEnd->getLastInsertID();


                // var_dump( 'none' );


                echo $this->render('templates/row', [
                    'fields' => $item->field,
                    'form' => $form,
                    'model' => $model,
                    'row' => true,
                    'table_name' => $table_name,
                    'settingsCropper' => $settingsCropper,
                    'row_id' => $row_id,
                    'sub_row_id' => $sub_row_id
                ]);
                // if($table_name->getGalleries()){
                //     echo $this->render('gallery', ['table' => $table_name, 'row_id' => $row_id, 'row' => true]);  //Вывод галереи
                // }                    
            }
        }
        if (Yii::$app->controller->action->id != 'edit' && $table_name->name !== 'accessory_char') {
            echo $this->render('templates/row', ['fields' => $fields, 'form' => $form, 'model' => $model, 'row' => true, 'table_name' => $table_name, 'settingsCropper' => $settingsCropper]);
        }
    } else if ($item->linked->type_view == '2') { //на отдельной странице
        //ВЫВОД
        // var_dump(Yii::$app->request->referrer);
        echo "<div class='linked_header'><h1>" . $header . "</h1></div>";
        echo $this->renderAjax('_index', ['id' => $item->linked->table->id, 'row_id' => $row_id, 'parent_table' => $id]);
    } else if ($item->linked->type_view == '3') { //Обычный просмотр
        //ВЫВОД
        echo "<div class='linked_header'><h1>" . $header . "</h1></div>";
        // var_dump('Обычный прсомотр ');
        echo $this->render('templates/cart', ['table' => $item->linked->name_linked_table, 'field' => $item->linked->name_linked_table_field, 'id' => $row_id]);
    }
    //  else if ($item->linked->type_view == '4') { //Checkbox
    //     //ВЫВОД
    // var_dump($item->linked->type_view);
    //     echo "<div class='linked_header'><h1>" . $header . "</h1></div>";
    //     echo $this->render('templates/checkbox', ['table' => $item->linked->name_linked_table, 'form' => $form, 'checkbox_table' => $item->linked->checkbox_table, 'id' => $row_id]);
    // }

    if (Yii::$app->controller->action->id === 'edit') {
        if ($item->linkedcheckbox) {
            foreach ($item->linkedcheckbox as $key => $checkbox) {
                echo "<div class='linked_header'><h1>" . $checkbox->header_linked_table . "</h1></div>";
                echo $this->render('templates/checkbox', ['table' => $checkbox->name_linked_table, 'form' => $form, 'checkbox_table' => $checkbox->checkbox_table, 'id' => $row_id]);
            }
        }
    }
}




// }       
?>



<?php $form->end(); ?>