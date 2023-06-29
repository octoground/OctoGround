<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brief_service".
 *
 * @property int $id
 * @property string|null $title_service
 * @property int|null $brief_id
 */
class BriefService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brief_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brief_id'], 'integer'],
            [['title_service'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_service' => 'Title Service',
            'brief_id' => 'Brief ID',
        ];
    }
}
