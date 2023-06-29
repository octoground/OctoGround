<?php
/* @var $this yii\web\View */
/** @var \yii\data\ActiveDataProvider $provider */
use app\models\Field;
use yii\helpers\Html;
use yii\helpers\Url;


\app\assets\SiteAsset::register($this);


$this->title = 'Настройки обрезки изображения';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>
<a href="<?= Url::to(['create']); ?>" class="btn btn-default">Добавить</a>
<div class="row">
        <div class="col-lg-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $provider,
                'columns' => [
                    'table_id' => [
                        'value' => function($data) {
                                /** @var \app\models\Table $table */
                                $table = \app\models\Table::findOne($data->table_id);
                                return $table->alias;
                    }],
                    'title_column' => [
                        'value' => function($data) {
                            /** @var \app\models\Field $table */
                            $field = Field::find()->andWhere(['table_id' => $data->table_id])->andWhere(['name' => $data->title_column])->one();
                                return $field->alias;
                    }],
                    'width',
                    'height',
                    'path_name',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a('Редактировать', ['edit', 'id' => $data->id], ['class' => 'btn btn-info']) .
                            Html::a('Удалить', ['delete', 'id' => $data->id], ['class' => 'btn btn-danger', 'data-confirm' => 'Вы уверены?']);
                        }
                    ]
                ],
                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя'
                ],
            ]) ?>
        </div>
    </div>



