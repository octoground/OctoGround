<?php             
    echo '<li class="gallery">';
        // echo '<input type="hidden" value="'. $image . '" name="'. $galleries->destination_table_name .'[]"/>';
        echo '<input type="hidden" value="'. $image . '" name="gallery_' . $galleries->destination_table_name . '_' . $galleries->id . '_' . $row_id . '[]">';
        echo '<img class="imgMain" src="' . Yii::$app->urlManager->hostInfo . $image .'"/>';
        echo '<div class="deleteImage" onclick="deleteImage(this); return false;">';
            echo '<img src="/adm/images/delete_button.png" alt="">';
        echo '</div>';
    echo '</li>';          
?>