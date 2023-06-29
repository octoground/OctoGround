<?php

use yii\helpers\Url;
use app\modules\edit\models\Field;
use yii\widgets\Pjax;

$this->title = $table->alias;
\Yii::$app->user->setReturnUrl(\yii\helpers\Url::current());

app\assets\SiteAsset::register($this);
app\assets\EditAsset::register($this);
?>
<div class="row" >
    <div class="col-lg-12 edit_index">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>

        <div>
            <?php if (\Yii::$app->user->identity->is_admin) : ?>
                <a href="<?= Url::to(['/install/table/field', 'table_id' => $table->id]) ?>" target="_blank" class="btn btn-default"><i class="fa fa-cog" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if (!$table->is_Create) : ?>
                <a href="<?= \yii\helpers\Url::to(['create', 'table' => $table->id]) ?>" class="btn btn-default">
                <!-- <i class="fa fa-plus-circle" aria-hidden="true"></i> -->
                <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <?php Pjax::begin() ?>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $searchModel,
            'columns' => Field::getColumns($table, $searchModel),
            'showOnEmpty' => false,
            'pager' => [
                'firstPageLabel' => 'Первая',
                'lastPageLabel' => 'Последняя'
            ],
        ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>