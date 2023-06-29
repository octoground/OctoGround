<?php

namespace app\models;

use app\models\Field;
use app\models\Table;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "image_cropper_settings".
 *
 * @property integer $id
 * @property integer $table_id
 * @property string $title_column
 * @property string $width
 * @property string $height
 * @property string $path_name
 */
class ImageCropperSettings extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_cropper_settings';
    }
    public static function getAllTables()
    {
        return ArrayHelper::map(Table::find()->all(), 'id', 'alias');
    }
    public static function getColumns($table_id)
    {
        return ArrayHelper::map(Field::find()->andWhere(['table_id' => $table_id])->all(), 'name', 'alias');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_id', 'title_column', 'width', 'height', 'path_name'], 'required'],
            [['table_id'], 'integer'],
            [['title_column', 'width', 'height', 'path_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_id' => 'Название таблицы',
            'title_column' => 'Поле изображения',
            'width' => 'Ширина',
            'height' => 'Высота',
            'path_name' => 'Название папки (на английском)',
        ];
    }
}
