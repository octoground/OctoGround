<?php
/* @var $this yii\web\View */
/** @var \yii\data\ActiveDataProvider $provider */

use yii\helpers\Html;
use yii\helpers\Url;

\app\assets\SiteAsset::register($this);
$this->title = 'Список связных таблиц';
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
                    'linked_name',
                    'parent_table',
                    'name_linked_table',
                    'header_linked_table',
                    [
                        'label' => 'type_view',
                        'format' => 'raw',
                        'value' => function ($data) {
                            switch ($data->type_view) {
                                case '1':
                                    return "На одной странице";
                                    break;
                                
                                case '2':
                                    return "На отдельной странице";
                                    break;
                                case '3':
                                    return "Корзина";
                                    break;
                                case '4':
                                    return "Checkbox";
                                    break;
                                case '5':
                                    return "";
                                    break;
                                
                                default:
                                    
                                    break;
                            }
                            // return $data->type_view == 0 ? 'На одной странице' : 'На отдельной странице';
                        }
                    ],
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a('Удалить', ['delete', 'id' => $data->id], ['class' => 'btn btn-danger', 'data-confirm' => 'Вы уверены?']);
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



