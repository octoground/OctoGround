<?php

namespace app\modules\edit\models;

class Checkbox extends \app\models\Table
{
    public $t_name; //Наименнование таблицы
    public $checkbox_table; // Таблица, в которой хранятся значения checkbox
    public $checkbox;


    public function getTable($q = null)
    {
        $q = $this->t_name === 'accessory' ? 'title' : 'name';
        $q = $this->t_name === 'product_char' ? 'name_char' : $q;
        return \Yii::$app->dbFrontEnd->createCommand("SELECT id, {$q} FROM {$this->t_name}")->queryAll();
    }

    public function getArray($q = null)
    {
        $items = $this->getTable($q);
        $arr = [];

        foreach ($items as $key => $item) {
            $arr[$item['id']] = isset($item['name']) ? $item['name'] : $item['title'];
            $arr[$item['id']] = isset($item['name_char']) ? $item['name_char'] : $arr[$item['id']];
        }
        return $arr;
    }

    public function getSelected($id)
    {
        $arr = [];
        
        if (!\Yii::$app->dbFrontEnd->createCommand("SELECT table1 FROM {$this->checkbox_table} WHERE table2 = " . $id)->queryAll()) {
            return false;
        }
        $items = \Yii::$app->dbFrontEnd->createCommand("SELECT table1 FROM {$this->checkbox_table} WHERE table2 = " . $id)->queryAll();
        foreach ($items as $key => $item) {
            $arr[$this->checkbox_table][] = $item['table1'];
        }

        return $arr;
    }
}
