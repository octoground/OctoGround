<?php

namespace app\modules\users\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use app\modules\users\models\Users;



class Main extends Model
{
    public function search($params)
    {
        $query = Users::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

        $this->load($params);

        return $dataProvider;
    }

}