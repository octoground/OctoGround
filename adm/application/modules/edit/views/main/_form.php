<?php

use app\modules\edit\models\DynamicModel;
use yii\helpers\Url;
?>
<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'mainform']); ?>

<div class="row edit_row" style="margin-bottom: 0">
    <div class="col-lg-12">
        <div class="edit_setting_board">
            <div class="edit_content">
                <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Url::to(['index', 'id' => $id]); ?>" class="btn btn-success">Назад</a>
                <?php if (\Yii::$app->user->identity->is_admin) : ?>
                    <a href="<?= Url::to(['/install/table/field', 'table_id' => $id]) ?>" target="_blank" class="btn btn-success">Настройки таблицы</a>
                <?php endif; ?>

                <a href="#" type="" class="btn btn-default edit_update_not_exit" data-row-id="<?= $row_id ?>" data-page="<?= Yii::$app->controller->action->id ?>" data-table-id="<?= $id ?>" data-is-row="<?= $is_row ? $is_row : Yii::$app->getRequest()->getQueryParam('is_row') ?>" data-parent-table-id="<?= $parent_table ? $parent_table : Yii::$app->getRequest()->getQueryParam('parent_table_id') ?>" data-parent-row-id="<?= $parent_row ? $parent_row : Yii::$app->getRequest()->getQueryParam('parent_row_id') ?>" data-id-row="<?= $row_id ?>" data-id="">Сохранить</a>
                <button type="submit" class="btn btn-default">Сохранить и выйти</button>
            </div>
        </div>

        <?php foreach ($fields as $field) : ?>
            <?= $this->render('templates/field', compact('field', 'model', 'form', 'settingsCropper')) ?>
        <?php endforeach; ?>

        <?php if ($logicModel->gallery->issetGallery($model->table->name)) : ?>
            <?= $this->render('gallery', ['logicModel' => $logicModel, 'row_id' => yii::$app->request->get('id')]);  //Вывод галереи 
            ?>
        <?php endif; ?>

    </div>
</div>


<?php $form->end(); ?>
<?php

if ($logicModel->linked->issetLinked($model->linked($model->table->name))) {
    echo "<div class='linked_header'><h1>" . $logicModel->linked->link->header_linked_table . "</h1></div>";

    if ($logicModel->linked->link->type_view === 1) { //на одной странице

        $formLinked = \yii\widgets\ActiveForm::begin(['id' => 'linkedform']);
        $logicModel->linked->table = $logicModel->linked->getLinkedTable($logicModel->linked->link->name_linked_table);
        $model = $logicModel->linked->getDynamicModel();
        echo  $this->render('templates/_oneView', compact('logicModel', 'formLinked', 'model', 'settingsCropper'));
        $formLinked->end();
    }
}
?>