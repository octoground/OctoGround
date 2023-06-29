<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
// use yii\db\Expression;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $created_at
 * @property string $service
 */
class Order extends ActiveRecord
{
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'og_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['text', 'type'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'text' => 'Service',
            'email' => 'Service',
            'type' => 'Service',
        ];
    }
}
