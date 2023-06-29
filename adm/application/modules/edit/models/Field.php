<?php

namespace app\modules\edit\models;


use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\StringHelper;

class Field extends \app\models\Field
{

    /**
     * @return bool
     */
    private function fieldIsDate()
    {
        return ($this->edit_type_id !== null) && in_array($this->type->name, ['datetime', 'date', 'time']);
    }
    /**
     * @return int|string
     */
    public function getValidatorName()
    {
        if ($this->fieldIsDate()) {
            return 'string';
        }
        return in_array($this->php_type, ['string', 'double', 'integer']) ? $this->php_type : 'string';
    }


    /**
     * @return array
     */
    public function getValidatorOption()
    {
        if (($this->php_type == 'string') && ($this->data_type == 'string') && ($this->size !== null)) {
            return ['max' => $this->size];
        }
        return [];
    }

    /**
     * @param Table $table
     * @param DynamicModel $searchModel
     * @return array
     */
    // public static function getColumns(Table $table, $searchModel, $row_id = false, $parent_table)
    public static function getColumns(Table $table, $searchModel, $row_parent = false, $parent_table = false)
    {
        // var_dump($row_parent . ' row');
        // var_dump($row_parent . ' parent');
        $columns = [];
        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $table->id, 'is_visible_in_list' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($table->name)->columnNames])->all();
        // $galleries = $table->getGalleries();

        foreach ($fields as $field) {
            $format = $field->getFieldFormat();
            $label = $field->alias;
            $value = $field->name;

            
            switch ($format) {
                case 'text':
                    if (($table->name == 'news') && ($field->name == 'sort')) {
                        $columns[] = [
                            'attribute' => $value,
                            'label' => $label,
                            'format' => $format,
                            'content' => function ($data) use ($value, $table) {
                                return Html::textInput('value_sort', $data['sort'], ['class' => 'sort_for_news', 'data-news-id' => $data['id'], 'data-table-id' => $table['id']]);
                            }
                        ];
                    } else {
                        $columns[] = [
                            'attribute' => $value,
                            'label' => $label,
                            'format' => $format,
                            'value' => function ($data) use ($value) {
                                return StringHelper::truncate($data[$value], 200);
                            }
                        ];
                    }
                    break;
                case 'html':
                    $columns[] = [
                        'attribute' => $field->name,
                        'label' => $label,
                        'format' => $format,
                        'value' => function ($data) use ($value) {
                            return \Yii::$app->formatter->asHtml(StringHelper::truncate($data[$value], 200, '...', 'UTF-8', true));
                        }
                    ];
                    break;
                case 'image':
                    $columns[] = [
                        'label' => $label,
                        'format' => 'raw',
                        'value' => function($data) use ($value, $field) {
                            return Html::img($data[$value], Json::decode($field->showType->params));
                        },
                    ];
                    break;
                case 'relation':
                    $relation = Relation::findOne($field->relation_id);
                    if ($relation === null) {
                        $columns[] = "$value:$format:$label";
                    } else {
                        /** @var Relation $relation */
                        $columns[] = [
                            'attribute' => $value,
                            'label' => $label,
                            'format' => 'text',
                            'value' => function($data) use ($value, $field, $relation) {
                                return $relation->getValue($data[$value]);
                            },
                            'filter' => Html::activeDropDownList($searchModel, $value, $relation->getAllData(),['class'=>'form-control','prompt' => "Все"]),
                        ];
                    }
                    break;
                case 'boolean':
                    $columns[] = [
                        'attribute' => $value,
                        'label' => $label,
                        'format' => 'boolean',
                        'filter' => [1 =>'Да', 0 => 'Нет'],
                    ];
                    break;
                default:
                    $columns[] = "$value:$format:$label";
                    break;
            }
        }

        return ArrayHelper::merge($columns, [
            [
                'label' => '',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:130px'],
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) use ($table, $galleries, $row_parent, $parent_table) {
                    $row_id = $data['id'];
                    $is_row = $row_parent ? 1 : 0;
                    return
                        Html::a('<i class="fas fa-edit" style="margin: 0"></i>', ['edit', 'id' => $row_id, 'table' => $table->id, 'row_id' => $row_parent, 'parent_table' => $parent_table, 'is_row' => $is_row], ['class' => 'btn btn-info btn-xs']) .
                        
                        Html::a('<i class="fas fa-copy" style="margin: 0"></i>', ['double', 'id' => $row_id, 'table' => $table->id, 'row_id' => $row_parent, 'parent_table' => $parent_table, 'is_row' => $is_row], ['class' => 'btn btn-warning btn-xs', 'style' => 'margin: 0 10px']) .

                        Html::a('<i class="fas fa-trash-alt" style="margin: 0"></i>', ['delete', 'id' => $row_id, 'table' => $table->id], ['class' => 'btn btn-danger btn-xs edit_row_delete']);
                }
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getFieldFormat()
    {
        if ($this->show_type_id === null) {
            return 'text';
        }
        return $this->showType->format;
    }
}