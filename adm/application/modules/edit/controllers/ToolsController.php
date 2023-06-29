<?php

namespace app\modules\edit\controllers;

use yii;
use app\components\Controller;
use app\modules\edit\models\DynamicModel;
use yii\bootstrap\ActiveForm;
use app\modules\edit\models\Table;
use app\modules\edit\models\Linked;
use app\modules\edit\models\Gallery;
use app\modules\edit\models\Field;
use app\models\ImageCropperSettings;
use app\modules\edit\models\LogicModel;

class ToolsController extends Controller
{

    public function actions()
    {
        $this->enableCsrfValidation = false;
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => Yii::$app->request->hostInfo . '/images/improve', // Directory URL address, where files are stored.
                'path' => Yii::getAlias('@app') . '/../../images/improve', // Or absolute path to directory where files are stored.
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']], // These options are by default.
            ],
            'file-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'url' => Yii::$app->request->hostInfo . '/images/improve', // Directory URL address, where files are stored.
                'path' => Yii::getAlias('@app') . '/../../images/improve', // Or absolute path to directory where files are stored.
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetFilesAction',
                'url' => Yii::$app->request->hostInfo . '/images/improve', // Directory URL address, where files are stored.
                'path' => Yii::getAlias('@app') . '/../../images/improve', // Or absolute path to directory where files are stored.
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => Yii::$app->request->hostInfo . '/images/improve', // Directory URL address, where files are stored.
                'path' => Yii::getAlias('@app') . '/../../images/improve', // Or absolute path to directory where files are stored.
                'uploadOnlyImage' => false, // For any kind of files uploading.
            ],
        ];
    }
    //$table - $id таблицы из frontedDB
    //$linked - $id таблицы из sql
    public function actionDeleteImgGallery()
    {
        $str = yii::$app->request->post('str');
        $val = yii::$app->request->post('val');
        $expl = explode('_', $str);
        $gallery = Gallery::findOne(['id' => $expl[2]]);

        Yii::$app->dbFrontEnd->createCommand()->delete("{$gallery->source_table_name}", [$gallery->source_table_field_file => $val])->execute();
    }

    /**
     * id - id записи из связной таблицы
     * table - id связной таблицы
     */
    public function actionDeleteRow($id, $table) //удаление связной строки
    {
        $table = Table::findOne($table);
        Yii::$app->dbFrontEnd->createCommand()->delete("{$table->name}", ['id' => $id])->execute();
    }
    public function actionAddRow($table, $linked, $row) //добавление связной строки
    {
        $logicModel = new LogicModel();
        $logicModel->linked->issetLinked($linked);
        $tableModel = Table::findOne($table);

        Yii::$app->dbFrontEnd->createCommand()->insert("{$tableModel->name}", ['id' => null, "{$logicModel->linked->link->name_linked_table_field}" => $row])->execute(); //вставляем пустую строку в базу
        $row_from_bd['id'] = \Yii::$app->dbFrontEnd->getLastInsertID();
        $model = new DynamicModel([], ['table' => $tableModel]);
        $model->loadFromDB($row_from_bd['id']); //загружаем в модель эту пустую строку

        
        // var_dump();
        $formLinked = ActiveForm::begin();


        $arraySettingsCropper = ImageCropperSettings::find()->all();
        $settingsCropper = [];
        foreach ($arraySettingsCropper as $item) {
            $settingsCropper[$item->title_column] = $item;
        }
        
        
       
        // $linked = \Yii::$app->dbFrontEnd->getLastInsertID();
        return json_encode([
            'content' => $this->renderAjax('/main/templates/_oneViewEmpty', ['logicModel' => $logicModel, 'model' => $model, 'settingsCropper' => $settingsCropper, 'formLinked' => $formLinked, 'linked' => $row_from_bd]),
            'field' => $logicModel->linked->link->name_linked_table_field
        ]);
    }
    private function gallery($keys)
    {

        foreach ($keys as $key => $item) {
            $expl = explode('_', $item);
            $gallery = Gallery::findOne(['id' => $expl[2]]);

            foreach (yii::$app->request->post()[$item] as $key => $img) {
                $exists = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$gallery->source_table_name} WHERE {$gallery->source_table_field_file}='{$img}' ")->queryOne();
                if (!$exists) {
                    \Yii::$app->dbFrontEnd->createCommand()->insert("{$gallery->source_table_name}", ['id_item' => $expl[3], $gallery->source_table_field_file => $img])->execute();
                }
                
            }
        }
    }
    public function actionLinkedSave($row, $linked)
    {
        $form = yii::$app->request->post()["DynamicModel"];
    
        $arr = []; //формируем правильный массив для сохранения в базу данных
        foreach ($form as $key => $value) {
            $i = 0;
            foreach ($value as $k => $item) {
                $arr[$i][$key] = $item;
                $i++;
            }
        }
        
        $linked_table = Linked::findOne($linked);
        $table = Table::findOne($linked_table->id_linked_table);

        foreach ($arr as $key => $string) {
            \Yii::$app->dbFrontEnd->createCommand()->update("{$table->name}", $string, "id = {$string['id']}")->execute();           
        }

        $keys = array_keys(yii::$app->request->post());
        $keys = preg_grep ('/^gallery(\w+)/i', $keys);
        if ($keys) {
            $this->gallery($keys);
        }
    }
}
