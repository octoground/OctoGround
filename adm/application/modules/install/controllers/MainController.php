<?php

namespace app\modules\install\controllers;

use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use app\modules\install\models\Settings;

class MainController extends Controller
{
    /**
     * @var string
     */
    // public $layout = 'install';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->user->loginRequired();
            \Yii::$app->end();
            return true;
        }
        if (!\Yii::$app->user->identity->is_admin) {
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        if (!file_exists(\Yii::getAlias('@app'). '/' . 'config/database.db')) {
            copy(\Yii::getAlias('@app'). '/template_files/database.db', \Yii::getAlias('@app'). '/config/database.db');
        }


        return parent::beforeAction($action);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex() {
    
        $setting = Settings::find()->where(['id' => 1])->one();
        $setting->db_driver_name = 'mysql';




        if ($setting->load(\Yii::$app->request->post()) ) {
            if (\Yii::$app->dbFrontEnd->isActiveConnect($setting)){
                $setting->is_installed = 1;
                if ($setting->save()){
                    \Yii::$app->session->setFlash('success', 'Настройки успешно сохранены');
                    return $this->refresh();
                }else{
                    \Yii::$app->session->setFlash('danger', $setting->errors);
                }
            }else{
                \Yii::$app->dbFrontEnd->isActiveConnect($setting);
            }

        }

        return $this->render('index', [
            'setting' => $setting
        ]);
    }
}
