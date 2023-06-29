<?php

namespace app\modules\install\controllers;

use app\models\ImageCropperSettings;
use app\modules\install\models\Table;
use app\modules\install\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use app\modules\install\components\Controller;

class CropperController extends Controller
{
    /**
     * @var string
     */
    // public $layout = 'install';

    /**
     * @return string
     */
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => ImageCropperSettings::find()
        ]);
        // var_dump($provider);
        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $relation = new ImageCropperSettings();

        if ($relation->load(\Yii::$app->request->post()) && $relation->insert()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'relation' => $relation
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        /** @var ImageCropperSettings $relation */
        $relation = ImageCropperSettings::findOne($id);
        if ($relation->load(\Yii::$app->request->post()) && ($relation->update() !== false)) {
            return $this->redirect(['index']);
        }
        return $this->render('edit', [
            'relation' => $relation
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionDelete($id)
    {
        /** @var ImageCropperSettings $relation */
        $relation = ImageCropperSettings::findOne($id);
        $relation->delete();
        return $this->redirect(['index']);
    }
    public function actionGetColumnsTable()
    {
        $imageCropper = new ImageCropperSettings();
        return json_encode($this->renderAjax('column_list',[
            'table_id' => \Yii::$app->request->post('table_id'),
            'imageCropper' => $imageCropper
        ]));
    }
//    /**
//     * @param $table
//     * @return string
//     */
//    public function actionGetFields($table)
//    {
//        return Json::encode(Table::getFields($table));
//    }
}
