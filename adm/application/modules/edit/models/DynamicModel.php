<?php

namespace app\modules\edit\models;

use app\modules\install\models\Relation;
use app\modules\install\models\Linked;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\web\NotFoundHttpException;


/**
 * Class DynamicModel
 * @property Field[] fields
 * @package app\models
 */
class DynamicModel extends \yii\base\DynamicModel
{
    /**
     *
     */
    const DATE_TIME_FORMAT = 'd.MM.Y HH:mm:ss';
    /**
     *
     */
    const DATE_FORMAT = 'd.MM.Y';
    /**
     *
     */
    const TIME_FORMAT = 'HH:mm:ss';

    /**
     *
     */
    const DATE_TIME_FORMAT_DB = 'Y-MM-d HH:mm:ss';
    /**
     *
     */
    const DATE_FORMAT_DB = 'Y-MM-d';
    /**
     *
     */
    const TIME_FORMAT_DB = 'HH:mm';
    /**
     * @var Table
     */
    public $table;

    /**
     * @var Field[]
     */
    private $fieldsArray;

    /**
     *
     */
    public function init()
    {
        foreach ($this->fields as $field) {
            $this->defineAttribute($field->name);
            $this->addRule($field->name, $field->getValidatorName(), $field->getValidatorOption());
        }

        parent::init();
    }

    /**
     * Добавление новой записи в базу
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public function insert()
    {
        if (!$this->validate()) {
            return false;
        }
        // $connection = \Yii::$app->db->getSchema()->getCommandBuilder();
        // var_dump( $this->getProcessedDataForDB() );

        // if($row){

        //     return \Yii::$app->dbFrontEnd->createCommand()->batchInsert($this->table->name, $this->getProcessedDataForDB(), ['subject' => '1212', 'subject' => 'dsfsdf'])->execute();
        // }else{
        // var_dump( $this->getProcessedDataForDB() );
        // die;
        return \Yii::$app->dbFrontEnd->createCommand()->insert($this->table->name, $this->getProcessedDataForDB())->execute();
        // return 'asdasda';
        // }


    }


    /**
     * Обрабатываем все атрибуты для записи в бд
     *
     * @return array
     */
    private function getProcessedDataForDB()
    {
        $data = [];
        $primaryKeys = \Yii::$app->dbFrontEnd->getTableSchema($this->table->name)->primaryKey;

        // var_dump($this->attributes);
        foreach ($this->attributes as $name => $attribute) {
            $value = $this->convertPhpToDb($attribute, $name);
            //проверяем чтобы null значения записывались только для первичных ключей. Все null Значения игнорируем
            // if (in_array($name, $primaryKeys) || !(($value === null) || ($value === ''))) {
            if (in_array($name, $primaryKeys) || !(($value === null) || ($value === ''))) {
                $data[$name] = $value;
            }
        }
        return $data;
    }

    /**
     * Переводим данные из PHP типа в MYSQL тип для записи в базу
     *
     * @param $attribute
     * @param $name
     * @return bool|string
     */
    private function convertPhpToDb($attribute, $name)
    {
        switch ($this->getAttributeDataType($name)) {
            case 'datetime':
            case 'timestamp':
                return \Yii::$app->formatter->asDatetime((new \DateTime($attribute))->getTimestamp(), self::DATE_TIME_FORMAT_DB);
            case 'date':
                return \Yii::$app->formatter->asDate((new \DateTime($attribute))->getTimestamp(), self::DATE_FORMAT_DB);
            case 'time':
                return \Yii::$app->formatter->asTime((new \DateTime($attribute))->getTimestamp(), self::TIME_FORMAT_DB);
            case 'integer':
                if (in_array($this->getAttributeType($name), ['datetime', 'date'])) {
                    return \Yii::$app->formatter->asTimestamp((new \DateTime($attribute))->getTimestamp());
                }
                break;
        }
        return $attribute;
    }

    /**
     * Получаем тип извлеченный из базы
     *
     * @param $name
     * @return int
     */
    private function getAttributeDataType($name)
    {
        foreach ($this->fields as $field) {
            if ($field->name == $name) {
                return $field->data_type;
            }
        }
        return null;
    }

    /**
     * Получение типа для редактирования
     *
     * @param $name
     * @return null|string
     */
    private function getAttributeType($name)
    {
        foreach ($this->fields as $field) {
            if ($field->name == $name) {
                return $field->edit_type_id === null ? null : $field->type->name;
            }
        }
        return null;
    }

    /**
     * Обновление данных в базе
     *
     * @param $id
     * @return bool|int
     * @throws \yii\db\Exception
     */
    public function update($id)
    {
        if (!$this->validate()) {
            return false;
        }
        // var_dump($this->getProcessedDataForDB());
        //записываем в базу данные с формы
        // return \Yii::$app->dbFrontEnd->createCommand()->update($this->table->name, $this->getProcessedDataForDB(), ['id' => $id])->execute();
        return \Yii::$app->dbFrontEnd->createCommand()->update($this->table->name, $this->getProcessedDataForDB(), ['id' => $id])->execute();
    }

    /**
     * Выгрузка строки из базы по ID
     *
     * @param $id
     */
    public function loadFromDB($id)
    {
        //Считываем из базы данные в модель
        $this->setAttributes($this->getProcessedDataForPHP(\Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$this->table->name} WHERE id=:id")->bindValues([':id' => $id])->queryOne()));
    }
    /**
     * Выгрузка строки из связной таблицы по ключевому полу
     *
     * @param $id
     */
    public function loadFromDBLinked($id, $field)
    {
        //Считываем данные из связной таблицы
        return $this->getProcessedDataForPHP(\Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$this->table->name} WHERE {$field}={$id}")->queryAll());
    }
    public function getFromLinked($items)
    {
        return $this->setAttributes($items);       
    }
    public function getUpdate($id, $table)
    {
        if (!$this->validate()) {
            return false;
        }
        //записываем в базу данные с формы
        // return $this->getProcessedDataForPHP(\Yii::$app->dbFrontEnd->createCommand("UPDATE * FROM {$table} WHERE 'id'={$id}")->queryAll());
        return \Yii::$app->dbFrontEnd->createCommand()->update($table, $this->getProcessedDataForDB(), ['id' => $id])->execute();
    }
    /**
     * Обрабатываем все атрибуты для записи в бд
     * @param array $attributes
     * @return array
     */
    private function getProcessedDataForPHP($attributes)
    {
        $data = [];
        foreach ($attributes as $name => $attribute) {
            $data[$name] = $this->convertDbToPhp($attribute, $name);
        }
        return $data;
    }

    /**
     * Перевод из формата базы в формат PHP для дальнейшей обработки
     *
     * @param $attribute
     * @param $name
     * @return string
     */
    private function convertDbToPhp($attribute, $name)
    {
        switch ($this->getAttributeDataType($name)) {
            case 'datetime':
            case 'timestamp':
                return \Yii::$app->formatter->asDatetime((new \DateTime($attribute))->getTimestamp(), self::DATE_TIME_FORMAT);
            case 'date':
                return \Yii::$app->formatter->asDate((new \DateTime($attribute))->getTimestamp(), self::DATE_FORMAT);
            case 'time':
                return \Yii::$app->formatter->asTime((new \DateTime($attribute))->getTimestamp(), self::TIME_FORMAT);
            case 'integer':
                switch ($this->getAttributeType($name)) {
                    case 'datetime':
                        return \Yii::$app->formatter->asDatetime($attribute, self::DATE_TIME_FORMAT);
                    case 'date':
                        return \Yii::$app->formatter->asDatetime($attribute, self::DATE_FORMAT);
                }
                break;
        }
        return $attribute;
    }

    /**
     * Геттер, получение списка полей из таблицы Field
     * @return Field[]
     * @throws NotFoundHttpException
     */
    public function getFields()
    {
        if ($this->fieldsArray === null) {
            /** @var Table $tableModel */
            $this->fieldsArray = Field::find()->where(['table_id' => $this->table->id, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($this->table->name)->columnNames])->all();
        }
        return $this->fieldsArray;
    }

    /**
     * @param Field[] $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * Получем массива данных связанной таблицы
     * @param $name
     * @return array
     */
    public function getRelationArray($name)
    {
        $items = [];
        /** @var Relation $relation */
        $relation = Relation::findOne($this->getAttributeRelation($name));
        if ($relation !== null) {
            $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `{$relation->destination_table_field}`, `{$relation->destination_table_field_show}` FROM {$relation->destination_table_name}")->queryAll();
            foreach ($queryResult as $attributes) {
                $items[$attributes[$relation->destination_table_field]] = $attributes[$relation->destination_table_field_show];
            }
        }
        return $items;
    }

    /**
     * Получение связи таблицы
     * @param $name
     * @return int
     */
    public function getAttributeRelation($name)
    {
        foreach ($this->fields as $field) {
            if ($field->name == $name) {
                return $field->relation_id;
            }
        }
        return null;
    }

    /**
     * Метод поиска данных в списке
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params, $table = false, $row_id = false)
    {
        $query = ActiveQuery::create((new Query())->from($this->table->name));
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => \Yii::$app->dbFrontEnd->getTableSchema($this->table->name)->columnNames],
            'db' => 'dbFrontEnd'
        ]);

        if ($table && $row_id) {
            $linked = new Linked();
            $query->andFilterWhere([$linked->parentColumnName($table) => $row_id]);
        }
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $this->table->id, 'is_visible_in_list' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($this->table->name)->columnNames])->all();

        foreach ($fields as $field) {
            switch ($field->getFieldFormat()) {
                case 'boolean':
                case 'relation':
                    $query->andFilterWhere([$field->name => $this->{$field->name}]);
                    break;
                case 'image':
                    break;
                default:
                    $query->andFilterWhere(['like', $field->name, $this->{$field->name}]);
            }
        }

        return $dataProvider;
    }
    /**
     * Удаление записи из базы по id
     */
    public function delete($id, $table_name = false, $field = 'id')
    {
        $table = $table_name ? $table_name : $this->table->name;
        try {
            return \Yii::$app->dbFrontEnd->createCommand()->delete($table, [$field => $id])->execute();
        } catch (\Exception $e) {
            return false;
        }
    }

    //поулчение связных таблиц для редактирования
    public function linked($name)
    {
        $link = Linked::findOne(['parent_table' => $name]);
        return $link->id;
    }
}
