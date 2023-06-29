<?php
    use yii\helpers\Url;

    // echo "<div class='linked_header'><h1>". $logicModel->gallery->getGalleryTitle() ."</h1></div>";

    foreach($logicModel->gallery->getGalleries() as $key => $galleries){
        $rand = rand();
        // echo "<div class='row edit_row gallery_edit_row'>";
        echo "<div class='row gallery_edit_row'>";
            echo "<div class='col-lg-12'>";
                echo "<div class='gallery_linked_content'>";                       
                    echo "<label>" . $logicModel->gallery->getGalleryTitle(). "</label>";
                    
                    echo "<div class='gallery_linked_label'>";
            
                        foreach ($logicModel->gallery->getImgs() as $image){
                            
                            if($image){
                                echo $this->render('templates/gallery', compact('image', 'galleries'));   
                            }
                        }                     

                        echo "<label for='image-uploader". $rand ."' class='pre_gallery'>";
                            echo "<input type='file' accept='image/*' multiple='multiple' name='file' id='image-uploader". $rand ."' data-table='gallery_{$galleries->destination_table_name}_{$galleries->id}_{$row_id}'' class='hide gallery-uploader' data-upload-url='" . Url::to(['/tools/upload-image']) . "'>";
                            echo '<div class="edit_image_load">';
                                echo '<div class="edit_image_load_field">';

                                    echo "<i class='fa fa-plus-circle' aria-hidden='true'></i>"; 
                            
                                echo '</div>';
                            echo '</div>';
                        echo "</label>";
                    echo "</div>"; 
                echo "</div>"; 
            echo "</div>"; 
        echo "</div>"; 
    }
