<?php

namespace app\modules\chart\controllers;

use yii;
use yii\web\Controller;
use app\modules\chart\models\Data;
class MainController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * $type - тип изменения (неделя, месяц, год)
     */
    public function actionChangeDate($date, $type)
    {
        $model = new Data();
        $model->date = strtotime($date . ' 10:00');
        

        return json_encode([
            'content' => $model->getSets($type, Yii::$app->formatter->asDate($model->date, 'd')),
            'labels' => $model->labelChart($type, Yii::$app->formatter->asDate($model->date, 'd'))
        ]);
    }
}
