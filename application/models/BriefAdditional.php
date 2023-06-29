<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brief_additional".
 *
 * @property int $id
 * @property string|null $additional_title
 * @property int|null $brief_id
 */
class BriefAdditional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brief_additional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brief_id'], 'integer'],
            [['additional_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'additional_title' => 'Additional Title',
            'brief_id' => 'Brief ID',
        ];
    }
}
