<?php

namespace app\modules\edit\controllers;

use yii;
use app\components\Controller;
use app\models\ImageCropperSettings;
use app\modules\edit\models\Field;
use app\modules\edit\models\Table;
use app\modules\edit\models\DynamicModel;
use app\modules\edit\models\Gallery;
use app\modules\edit\models\LogicModel;


class MainController extends Controller
{
    //    public function actions(){
    //        return [
    //            'images-get' => [
    //                'class' => 'vova07\imperavi\actions\GetImagesAction',
    //                'url' => Url::to(['/images/upload']), // Directory URL address, where files are stored.
    //                'path' =>  '@app/../images/uploads', // Or absolute path to directory where files are stored.
    //                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']], // These options are by default.
    //            ],
    //        ];
    //    }


    public function actionIndex($id)
    {
        /** @var Table $table */
        $table = Table::findOne($id);
        $searchModel = new DynamicModel([], ['table' => $table]);


        $provider = $searchModel->search(\Yii::$app->request->queryParams);
        $list = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$table->name} WHERE id=:id")
            ->bindValues([
                ':id' => $id
            ])->queryAll();

        return $this->render('index', [
            'provider' => $provider,
            'table' => $table,
            'searchModel' => $searchModel,
            'list' => $list,
        ]);
    }

    public function actionEdit($id, $table)
    {

        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);

        /** @var Field[] $fields */

        $fields = Field::find()
            ->where(['table_id' => $tableModel->id, 'is_editable' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($tableModel->name)->columnNames])
            ->all();

        $settingsCropper = ImageCropperSettings::find()
            ->andWhere(['table_id' => $tableModel->id])
            ->all();

        $arraySettingsCropper = [];
        foreach ($settingsCropper as $item) {
            $arraySettingsCropper[$item->title_column] = $item;
        }
        //СОздаем динамическую модель для валидаии данных
        $model = new DynamicModel([], ['table' => $tableModel]);
        $model->loadFromDB($id);

        $logicModel = new LogicModel();
        $logicModel->table = $tableModel;

        if ($model->load(\Yii::$app->request->post())) {

            foreach (Yii::$app->request->post() as $key => $data) {
                $expl = explode("_", $key);
                $expl_name = $expl[0]; //если есть "gallery", то выполняем условие
                $expl_id_gallery = $expl[2];
                $expl_id = $expl[3];
                // var_dump($expl_id_gallery);
                if ($expl_name === 'gallery') {
                    $logicModel->gallery->uploadGallery($expl_id, $expl_id_gallery, $data);
                }
            }
            // var_dump(\Yii::$app->request->post());
            if ($model->update($id) !== false) {
                \Yii::$app->session->setFlash('success', 'Запись успешно обновлена');
                return $this->goBack();
            }
        }

        return $this->render('edit', [
            'fields' => $fields,
            'model' => $model,
            'table' => $tableModel,
            'settingsCropper' => $arraySettingsCropper,
            'logicModel' => $logicModel
        ]);
    }

    public function actionChangeSort()
    {
        $table = \Yii::$app->request->post('table');
        $id = \Yii::$app->request->post('id');
        $value_sort = \Yii::$app->request->post('value_sort');
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $tableModel->id, 'is_editable' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($tableModel->name)->columnNames])->all();
        //СОздаем динамическую модель для валидаии данных
        $model = new DynamicModel([], ['table' => $tableModel]);
        $model->loadFromDB($id);
        $model->sort = $value_sort;
        if ($model->update($id) !== false) {
            \Yii::$app->session->setFlash('success', 'Запись успешно отредактирована');
            return $this->goBack();
        }
    }
    public function actionDelete($id, $table)
    {
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        //СОздаем динамическую модель для валидаии данных
        $model = new DynamicModel([], ['table' => $tableModel]);
        if ($model->delete($id) === false) {
            \Yii::$app->session->setFlash('danger', 'Не удалось удалить запись');
        } else {
            \Yii::$app->session->setFlash('success', 'Запись успешно удалена');
        }
        return $this->goBack();
    }

    // public function actionUploadGallery($id, $table, $gallery)
    // {
    //     /** @var Table $tableModel */
    //     $tableModel = Table::findOne($table);
    //     /** @var Gallery $galleryModel */
    //     $galleryModel = Gallery::findOne($gallery);
    //     $galleryModel->loadImages($id);
    //     if (\Yii::$app->request->isPost && $galleryModel->saveImages(\Yii::$app->request->post('images', []), $id)) {
    //         return $this->goBack();
    //     }
    //     return $this->render('gallery', [
    //         'gallery' => $galleryModel,
    //         'table' => $tableModel
    //     ]);
    // }

    public function actionCreate($table)
    {
        /** @var Table $tableModel */
        $tableModel = Table::findOne($table);
        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $tableModel->id, 'is_editable' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($tableModel->name)->columnNames])->all();
        $settingsCropper = ImageCropperSettings::find()->andWhere(['table_id' => $tableModel->id])->all();
        $arraySettingsCropper = [];
        foreach ($settingsCropper as $item) {
            $arraySettingsCropper[$item->title_column] = $item;
        }
        $model = new DynamicModel([], ['table' => $tableModel]);
        $logicModel = new LogicModel();
        $logicModel->table = $tableModel;

        if ($model->load(\Yii::$app->request->post())) {

            if ($model->insert()) {
                \Yii::$app->session->setFlash('success', 'Запись успешно создана');
                $lastID = Yii::$app->dbFrontEnd->getLastInsertID();
                $logicModel->gallery->galleryAdd(Yii::$app->request->post(), $lastID);
                return $this->goBack();
            }
        }
        return $this->render('create', [
            'fields' => $fields,
            'model' => $model,
            'table' => $tableModel,
            'settingsCropper' => $arraySettingsCropper,
            'logicModel' => $logicModel,

        ]);
    }
    public function actionCropImage()
    {
        return $this->renderAjax('/templates/modal');
    }
}
