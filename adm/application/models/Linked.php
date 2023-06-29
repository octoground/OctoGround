<?php

namespace app\models;

use Yii;
// use app\models\Table;

use yii\helpers\ArrayHelper;
use app\modules\edit\models\Table;
use app\modules\edit\models\DynamicModel;

class Linked extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linked';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_view'], 'integer'],
            [['parent_table', 'name_linked_table', 'name_linked_table_field', 'checkbox_table'], 'safe'],
            [['linked_name', 'header_linked_table', 'type_view', 'parent_table', 'name_linked_table', 'linked_name'], 'required'],
            [['linked_name', 'header_linked_table'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'linked_name' => 'Название связи',
            'parent_table' => 'Родительская таблица',
            'name_linked_table' => 'Название связной таблицы',
            'header_linked_table' => 'Заголовок связной таблицы',
            'type_view' => 'Тип отображения',
            'name_linked_table_field' => 'Поле для храненея ключа',
            'checkbox_table' => 'Таблица хранения checkbox',
        ];
    }
}
