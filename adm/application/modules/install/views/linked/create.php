<?php

/* @var $this yii\web\View */
use app\modules\install\models\Linked;
use yii\helpers\Url;

/** @var Relation $relation */
\app\assets\RelationAsset::register($this);
$this->title = 'Связь';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->title; ?>
        </h1>
    </div>
</div>
<a href="<?= Url::to(['index']); ?>" class="btn btn-success">Назад</a>


<div class="row">
    <div class="col-lg-12">
        <?php $form = \yii\widgets\ActiveForm::begin([]); ?>
            <?= $form->field($linked, 'linked_name')->textInput(); ?>
            <?= $form->field($linked, 'parent_table')->dropDownList(['' => 'Выберите таблицу'] + Linked::getAllTables(), ['class' => 'get-fields form-control', 'data-dependent-selector' => '.source_table_field']); ?>
            <?= $form->field($linked, 'name_linked_table')->dropDownList(['' => 'Выберите связную таблицу'] + Linked::getAllTables(), ['class' => 'get-fields form-control', 'data-dependent-selector' => '.name_linked_table_field']); ?>
            <?= $form->field($linked, 'name_linked_table_field')->dropDownList(Linked::getAllFields($linked->name_linked_table), ['class' => 'name_linked_table_field form-control']); ?>
            <?= $form->field($linked, 'header_linked_table')->textInput(); ?>
            <?= $form->field($linked, 'type_view')->dropDownList(['1' => 'На одной странице', '2' => 'На отдельной странице', '3' => 'Корзина', '4' => 'Checkbox'],
                ['class' => 'name_linked_table form-control',                                            
                'onchange' => '
                let _this = $("#linked-type_view").val();  
                console.log(_this === "4");  
                if(_this === "4"){
                    $("#linked-checkbox_table").css("display", "block");
                }else{
                    $("#linked-checkbox_table").css("display", "none");
                }
                '
                ] ); ?>
            <!-- <= $form->field($linked, 'checkbox_table')->dropDownList($linked->tables, -->
            ['class' => 'name_linked_table form-control', 'style' => 'display: none'] )->label(false); ?>
        <button type="submit" class="btn btn-default">Сохранить</button>
        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</div>



