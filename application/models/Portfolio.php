<?php

namespace app\models;

use Yii;
use app\models\PortfolioType;

/**
 * This is the model class for table "portfolio".
 *
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $img
 * @property string $url
 */
class Portfolio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['title', 'type'], 'string', 'max' => 50],
            [['img', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'img' => 'Img',
            'url' => 'Url',
            'type' => 'Type',
        ];
    }

    public function getTypeItem()
    {
        return $this->hasOne(PortfolioType::class, ['id' => 'type']);
    }
}
