<?php

namespace app\modules\users\controllers;

use yii\web\Controller;
use app\models\User;
use app\modules\users\models\Main;


class MainController extends Controller
{
    public function actionIndex()
    {
        $data = $this->main()->search(\Yii::$app->request->queryParams);
        return $this->render('index', compact('users', 'data'));
    }

    private function main(){
        return new Main();
    }
}
