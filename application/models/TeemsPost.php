<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teems_post".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Teems[] $teems
 */
class TeemsPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teems_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Teems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeems()
    {
        return $this->hasMany(Teems::className(), ['post' => 'id']);
    }
}
