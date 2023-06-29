<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use lavrentiev\widgets\toastr\Notification;
use app\modules\edit\models\Table;
use app\modules\edit\models\Field;
use app\modules\edit\models\DynamicModel;

$table1 = Table::findOne($id);
$searchModel1 = new DynamicModel([], ['table' => $table1]);
$provider1 = $searchModel1->search(\Yii::$app->request->queryParams, $parent_table, $row_id);
?>
<div class="row">
    <div class="col-lg-12 edit_index">
        <h1 class="page-header">

        </h1>
        <div>
            <?php if (\Yii::$app->user->identity->is_admin) : ?>
                <a href="<?= Url::to(['/install/table/field', 'table_id' => $table1->id]) ?>" target="_blank" class="btn btn-success">Настройки таблицы</a>
            <?php endif; ?>
            <a href="<?= \yii\helpers\Url::to(['create', 'table' => $table1->id, 'is_row' => true, 'parent_row_id' => $row_id, 'parent_table_id' => $parent_table]) ?>" class="btn btn-warning connected">Создать</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $provider1,
            'filterModel' => $searchModel1,
            // 'filterUrl' => Url::to(['adm/main/t']),
            'columns' => Field::getColumns($table1, $searchModel1, $row_id, $parent_table, $parent_row, $is_row = true),
            'showOnEmpty' => false,
            'pager' => [
                'firstPageLabel' => 'Первая',
                'lastPageLabel' => 'Последняя'
            ],
        ]) ?>

    </div>
</div>