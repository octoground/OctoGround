<?php

namespace app\modules\edit\models;

use yii;
use yii\db\QueryBuilder;
use yii\helpers\ArrayHelper;

class Gallery extends \app\models\Gallery
{
    public $images;
    public $gallery;
    public $row; 

    /**
     * проверяем на существования галерии
     */

    public function issetGallery($name)
    {
        $gallery = $this->find()->where(['destination_table_name' => $name])->one();
        $this->gallery = $gallery ? $gallery : false;
        return $this->gallery;
    }

    public function getGalleries()
    {
        $galleries = $this->find()->where(['destination_table_name' => $this->gallery->destination_table_name])->all();

        return $galleries;
    }


    public function getImgs()
    {
        $id = $this->row ? $this->row : yii::$app->request->get('id');
        $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$this->gallery->source_table_name} WHERE `{$this->gallery->source_table_field}` = :id ")->bindValues([':id' => $id])->queryAll();
        // var_dump($this->gallery);
        return $queryResult;
    }

    public function getGalleryTitle()
    {
        return $this->gallery->name;
    }

    public function uploadGallery($id, $gallery, $data)
    {
        $this->gallery = $this->find()->where(['id' => $gallery])->one();
        $this->loadImages($id);
        $this->saveImages($data, $id);
    }


    public function saveImages($images, $id)
    {
        $transaction = \Yii::$app->dbFrontEnd->beginTransaction();
        try {
            $arrayForDelete = array_values(array_diff($this->images, $images));
            if (count($arrayForDelete) > 0) {
                $delCond = [$this->gallery->source_table_field => $id, $this->gallery->source_table_field_file => $arrayForDelete];
                $query = new QueryBuilder(\Yii::$app->dbFrontEnd);
                $params = [];
                \Yii::$app->dbFrontEnd->createCommand()->delete($this->gallery->source_table_name, $query->buildCondition($delCond, $params), $params)->execute();
            }
            $arrayForInsert = array_diff($images, $this->images);
            if (count($arrayForInsert) > 0) {
                array_walk($arrayForInsert, function (&$element) use ($id) {
                    $element = [$id, $element];
                });
                \Yii::$app->dbFrontEnd->createCommand()->batchInsert($this->gallery->source_table_name, [$this->gallery->source_table_field, $this->gallery->source_table_field_file], $arrayForInsert)->execute();
            }
            $transaction->commit();
            $this->loadImages($this->gallery->id);
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
    private function getImagesArray($id)
    {
        $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `id`, `{$this->gallery->source_table_field_file}` FROM {$this->gallery->source_table_name} WHERE `{$this->gallery->source_table_field}` = :id ")->bindValues([':id' => $id])->queryAll();
        return ArrayHelper::map($queryResult, 'id', $this->gallery->source_table_field_file);
    }


    public function loadImages($id)
    {

        $this->images = $this->getImagesArray($id);
    }
    public function galleryAdd($data, $id = null)
    {
        foreach (Yii::$app->request->post() as $key => $data) {
            $expl = explode("_", $key);
            $expl_name = $expl[0]; //если есть "gallery", то выполняем условие
            $expl_id_gallery = $expl[2];
            $expl_id = $id ? $id : $expl[3];

            if ($expl_name === 'gallery') {
                $this->uploadGallery($expl_id, $expl_id_gallery, $data);
            }
        }
    }































    // /**
    //  * Получение значения из связи, по конкретному значению destination_table_field
    //  *
    //  * @param $id
    //  * @return mixed
    //  */
    // public function getValue($id)
    // {
    //     $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `{$this->destination_table_field}` FROM {$this->destination_table_name} WHERE `{$this->destination_table_field}` = :id ")->bindValues([':id' => $id])->queryOne();
    //     return ArrayHelper::getValue($queryResult, $this->destination_table_field);
    // }

    // /**
    //  * @param $id
    //  * @return array
    //  */
    // private function getImagesArray($id)
    // {
    //     $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `id`, `{$this->source_table_field_file}` FROM {$this->source_table_name} WHERE `{$this->source_table_field}` = :id ")->bindValues([':id' => $id])->queryAll();
    //     return ArrayHelper::map($queryResult, 'id', $this->source_table_field_file);
    // }
    // public function getImages($id)
    // {
    //     $queryResult = \Yii::$app->dbFrontEnd->createCommand("SELECT `id`, `{$this->source_table_field_file}` FROM {$this->source_table_name} WHERE `{$this->source_table_field}` = :id ")->bindValues([':id' => $id])->queryAll();
    //     return ArrayHelper::map($queryResult, 'id', $this->source_table_field_file);
    // }

    // /**
    //  * @param $images
    //  * @param $id
    //  * @return bool
    //  * @throws \Exception
    //  * @throws \yii\db\Exception
    //  */
    // public function saveImages($images, $id)
    // {
    //     $transaction = \Yii::$app->dbFrontEnd->beginTransaction();
    //     try {
    //         $arrayForDelete = array_values(array_diff($this->images, $images));
    //         if (count($arrayForDelete) > 0) {
    //             $delCond = [$this->source_table_field => $id, $this->source_table_field_file => $arrayForDelete];
    //             $query = new QueryBuilder(\Yii::$app->dbFrontEnd);
    //             $params = [];
    //             \Yii::$app->dbFrontEnd->createCommand()->delete($this->source_table_name, $query->buildCondition($delCond, $params), $params)->execute();
    //         }
    //         $arrayForInsert = array_diff($images, $this->images);
    //         if (count($arrayForInsert) > 0) {
    //             array_walk($arrayForInsert, function (&$element) use ($id) {
    //                 $element = [$id, $element];
    //             });
    //             \Yii::$app->dbFrontEnd->createCommand()->batchInsert($this->source_table_name, [$this->source_table_field, $this->source_table_field_file], $arrayForInsert)->execute();
    //         }
    //         $transaction->commit();
    //         $this->loadImages($id);
    //         return true;
    //     } catch (\Exception $e) {
    //         $transaction->rollBack();
    //         throw $e;
    //     }
    // }

    // /**
    //  * @param $id
    //  */
    // public function loadImages($id = null)
    // {
    //     $this->images = $this->getImgs($id);
    // }
}
