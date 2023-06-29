<?php

    echo "<div class='row edit_row edit_row_linked'>";
        echo "<div class='col-lg-12'>";
            echo "<div class='linked_content'>";
                echo "<div class='edit_row_linked_delete'>";
                    echo '<a class="btn btn-danger btn-xs edit_row_delete" href="/adm/edit/tools/delete-row?id=' . $linked['id'] . '&table=' . $model->table->id . '"><i class="fas fa-trash-alt" style="margin: 0"></i></a>';
                echo "</div>";
                foreach($logicModel->linked->getFields() as $key => $field){
                    echo $this->render('field',['field' => $field, 'model' => $model, 'form' => $formLinked, 'settingsCropper' => $formLinked, 'linked' => true]);  
                }
              
                if ($logicModel->gallery->issetGallery($model->table->name)){
                    $logicModel->gallery->row = $linked['id'];
                    echo $this->render('../gallery', ['logicModel' => $logicModel, 'row_id' => $linked['id']]);  //Вывод галереи 
                }
            echo "</div>"; 
        echo "</div>"; 
    echo "</div>";
