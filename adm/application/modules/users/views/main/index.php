<?php
    $this->title = 'Пользователи';

    use yii\grid\GridView;
    use yii\helpers\html;
    use yii\helpers\Url;
    app\assets\SiteAsset::register($this);
?>

<div class="row">
    <div class="col-lg-12 edit_index">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
        <div>
     
            <a href="<?= Url::to(['/install/table/field', 'table_id' => $table->id]) ?>" class="btn btn-success">Должности</a>
            <a href="<?= \yii\helpers\Url::to(['create', 'table' => $table->id])?>" class="btn btn-warning">Добавить</a>
       
        </div>
    </div>
</div>


<?= GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'fio:text:ФИО',
        'username:text:Email',
        'role:text:Должность',

        [
            'attribute' => 'is_admin',
            'label' => 'Бог',
            'format' => 'boolean',
            'filter' => [1 =>'Да', 0 => 'Нет'],
        ],

        'created_at:text:Добавлен',
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=> '', 
            'headerOptions' => ['width' => '100px'],
            'contentOptions' => ['style' => 'text-align: center'],
            'template' => '{edit} {delete}',
            'buttons' => [
                'edit' => function ($url,$model) {
                    return Html::a(
                    '<i class="fas fa-edit" style="margin: 0"></i>', 
                    $url, ['class' => 'btn btn-info btn-xs']);
                },
                'delete' => function ($url,$model) {
                    return Html::a(
                    '<i class="fas fa-trash-alt" style="margin: 0"></i>', 
                    $url, ['class' => 'btn btn-danger btn-xs edit_row_delete', 'style' => 'margin-left: 10px']);
                },
            ],   
        ],

    ]
]); ?>
