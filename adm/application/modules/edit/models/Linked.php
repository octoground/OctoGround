<?php

namespace app\modules\edit\models;

use yii;
use yii\db\ActiveRecord;
use app\modules\edit\models\Field;
use app\modules\edit\models\Table;
use app\modules\edit\models\DynamicModel;

/**
 * @inheritdoc
 */
class Linked extends \app\models\Linked
{
    public $link;
    public $table; //id связной таблицы 
    public $row; //id записи из этой таблицы 
    public $field; //Поле из связной таблицы, в которой хранится id родительской записи

    /**
     * проверяем на существование связной таблицы
     */
    public function issetLinked($name)
    {
        $this->link = $this::findOne($name);
        return $this->link;
    }

    public function getLinkedTable($name)
    {
        $table = Table::findOne(['name' => $name]);
        return $table->id;
    }
    public function getFields()
    {
        $fields = Field::find()->where(['table_id' => $this->link->id_linked_table, 'is_editable' => true])->all();
        return $fields;
    }
    public function getDynamicModel()
    {
        $tableModel = Table::findOne($this->table);
        $model = new DynamicModel([], ['table' => $tableModel]);
        $this->row = Yii::$app->getRequest()->getQueryParam('id'); //id в дочерней таблицы для выборки
        $this->field = $this->link->name_linked_table_field; //id в дочерней таблицы для выборки

        return $model;
    }
}
