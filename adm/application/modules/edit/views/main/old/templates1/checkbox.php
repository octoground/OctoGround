<?php
use app\modules\edit\models\Checkbox;

$model = new Checkbox();
$model->t_name = $table;
$model->checkbox_table = $checkbox_table;

$model->checkbox = $model->getSelected($id);

echo "<div class='row edit_row'>";
    echo "<div class='col-lg-12'>";
        echo "<div class='linked_content'>";

            echo $form->field($model, 'checkbox[' . $model->checkbox_table . ']')->checkboxList($model->array)->label(false);

        echo "</div>";
    echo "</div>";
echo "</div>";
