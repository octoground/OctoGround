<?php
    use yii\helpers\Url;

    echo "<div class='row edit_row'>";
        echo "<div class='col-lg-12'>";
            echo "<div class='linked_content'>";
                foreach($fields as $key => $field){
                    // var_dump($model);
                    if($field->name && $field->name !== 'img'){ #Пропускаем пустые значения
                        echo $this->render('field', compact('field', 'model', 'form', 'row', 'settingsCropper', 'sub_row_id'));
                    }else{
                        echo "<div class='hide_row_js'></div>";
                    }
                }


                /**
                 * Подключение галереи
                 */
                $c_galery = count($table_name->getGalleries());        
                foreach($table_name->getGalleries() as $key => $galleries){
                    $galleries->loadImages($sub_row_id);      
                    $rand = rand();
                    echo "<div class='gallery_linked_content linked_content'>";                       
                        echo "<label>" . $galleries->name . "</label>";
                        
                        echo "<div class='gallery_linked_label'>";

                            foreach ($galleries->images as $image){
                                if($image){
                                    echo $this->render('gallery', compact('image', 'galleries'));   
                                }
                            }                     

                            echo "<label for='image-uploader". $rand ."' class='pre_gallery'>";
                                echo "<input type='file' accept='image/*' multiple='multiple' name='file' id='image-uploader". $rand ."' class='hide gallery-uploader' data-table='gallery_{$galleries->destination_table_name}_{$galleries->id}_{$sub_row_id}'' data-upload-url='" . Url::to(['/tools/upload-image']) . "'>";
                                echo '<div class="edit_image_load">';
                                    echo '<div class="edit_image_load_field">';

                                        echo "<i class='fa fa-plus-circle' aria-hidden='true'></i>"; 
                                
                                    echo '</div>';
                                echo '</div>';
                            echo "</label>";
                        echo "</div>"; 
                    echo "</div>"; 
                }

                /**
                 * конец
                 */



                echo "<div class='edit_btn_group'>";
                    echo "<span class='btn btn-default linked_content_delete'>Удалить</span>";
                    echo "<span class='btn btn-default edit_btn_group_add' data-table='". $table_name->name ."'>Добавить поля</span>";
                echo "</div>"; 
            echo "</div>"; 
        echo "</div>"; 
    echo "</div>"; 

?>