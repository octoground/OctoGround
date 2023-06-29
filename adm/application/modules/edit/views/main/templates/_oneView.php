<?php
    use yii\helpers\Url;
    
    foreach ($model->loadFromDBLinked($logicModel->linked->row, $logicModel->linked->field) as $key => $linked) {      
        $model->getFromLinked($linked);   
        echo $this->render('_oneViewEmpty', compact('logicModel', 'model', 'formLinked', 'settingsCropper', 'linked'));
    }
   
    echo "<div class='edit_btn_group'>";
        // echo "<span class='btn btn-default linked_content_delete'>Удалить</span>";
        // var_dump($logicModel->linked->link->name_linked_table);
        // echo "<span class='btn btn-default edit_btn_group_add' data-table='". $logicModel->linked->link->name_linked_table ."'>Добавить поля</span>";
        echo "<span class='btn btn-default edit_btn_group_add' data-row='".  Yii::$app->getRequest()->getQueryParam('id') ."' data-table='". $logicModel->linked->table ."' data-linked='". $logicModel->linked->link->id ."'>Добавить поля</span>";
    echo "</div>"; 
