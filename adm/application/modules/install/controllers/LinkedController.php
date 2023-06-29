<?php

namespace app\modules\install\controllers;

use app\modules\install\models\Table;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use app\modules\install\components\Controller;
use app\modules\install\models\Linked;

class LinkedController extends Controller
{
    // public $layout = 'install';



    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Linked::find()
        ]);
        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    public function actionCreate()
    {
        $linked = new Linked();
        if ( $linked->load(\Yii::$app->request->post()) ) {

            $table = Table::find()->where(['name' => $linked->name_linked_table])->one();
            $linked->id_linked_table = $table->id;
            if($linked->type_view !== '4'){
                $table->is_linked = 1;
            }
            

            // var_dump(\Yii::$app->request->post());
            if($linked->save() && $table->save()){
                return $this->redirect(['index']);
            }  
        }
        return $this->render('create', [
            'linked' => $linked
        ]);
    }

    public function actionDelete($id)
    {
        $linked = Linked::findOne($id);

        $table = Table::find()->where(['name' => $linked->name_linked_table])->one();
        $table->is_linked = 0;
     
        if($table->save()){
            $linked->delete();
            return $this->redirect(['index']);
        }
    }
}
