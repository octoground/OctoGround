<?php
    use yii\helpers\Url;
    use app\modules\edit\models\Field;
    use yii\widgets\Pjax;
    use lavrentiev\widgets\toastr\Notification;

    app\assets\SiteAsset::register($this);
    $this->title = $table->alias;
    \Yii::$app->user->setReturnUrl(\yii\helpers\Url::current());
?>
<div class="row">
    <div class="col-lg-12 edit_index">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
        
        <div>
            <?php if(\Yii::$app->user->identity->is_admin): ?>
                <a href="<?= Url::to(['/install/table/field', 'table_id' => $table->id]) ?>" target="_blank" class="btn btn-success">Настройки таблицы</a>
            <?php endif; ?>
            <?php if(!$table->is_Create): ?>
                <a href="<?= \yii\helpers\Url::to(['create', 'table' => $table->id])?>" class="btn btn-warning">Создать</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php 
    foreach (Yii::$app->session->getAllFlashes() as $type => $message){                
        if (in_array($type, ['success', 'danger', 'warning', 'info'])){
            $type = $type == 'danger' ? 'error' : $type;
            Notification::widget([
                'type' => $type,
                'message' => $message
            ]);
        }
    }
?>

<div class="row">
    <div class="col-lg-12">
        <?php Pjax::begin() ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $provider,
                'filterModel' => $searchModel,
                // 'filterUrl' => Url::to(['site/index']),
                'columns' => Field::getColumns($table, $searchModel),
                'showOnEmpty' => false,
                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя'
                ],
            ]) ?>
        <?php Pjax::end(); ?>
        
    </div>
</div>