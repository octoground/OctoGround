<?php             
    echo '<li class="gallery">';
        echo '<input type="hidden" value="'. $image[$galleries->source_table_field_file] . '" name="gallery_' . $galleries->destination_table_name . '_' . $galleries->id . '_' . $image[$galleries->source_table_field] . '[]">';
        echo '<img class="imgMain" src="' . Yii::$app->urlManager->hostInfo . $image[$galleries->source_table_field_file] .'"/>';
        echo '<div class="deleteImage" onclick="deleteImage(this); return false;">';
            echo '<img src="/adm/images/delete_button.png" alt="">';
        echo '</div>';
    echo '</li>';
