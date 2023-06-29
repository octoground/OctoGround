<?php

namespace app\controllers;

use app\components\Controller;
use app\modules\install\models\Settings;
use app\modules\chart\models\Chart;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $setting = Settings::find()->where(['is_installed' => true])->one();
        if (
            !$setting->db_password ||
            !$setting->db_username ||
            !$setting->db_driver_name ||
            !$setting->db_host ||
            !$setting->db_name
        ) {
            return $this->redirect(['install/main/index']);
        }

        // $chart = new Chart();
        
        return $this->render('index', compact('chart'));
    }
}
