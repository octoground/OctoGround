<?php

namespace app\models;

use Yii;
use app\models\TeemsPost;
/**
 * This is the model class for table "teems".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $fio
 * @property int|null $post
 * @property int|null $create_at
 * @property string|null $desc
 * @property string|null $vc
 * @property string|null $fb
 * @property string|null $inst
 * @property string|null $telegram
 * @property string|null $whatsup
 *
 * @property TeemsPost $post0
 */
class Teems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post', 'create_at'], 'integer'],
            [['desc'], 'string'],
            [['img'], 'string', 'max' => 255],
            [['fio'], 'string', 'max' => 80],
            [['vc', 'fb', 'inst', 'telegram', 'whatsup'], 'string', 'max' => 50],
            [['post'], 'exist', 'skipOnError' => true, 'targetClass' => TeemsPost::className(), 'targetAttribute' => ['post' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'fio' => 'Fio',
            'post' => 'Post',
            'create_at' => 'Create At',
            'desc' => 'Desc',
            'vc' => 'Vc',
            'fb' => 'Fb',
            'inst' => 'Inst',
            'telegram' => 'Telegram',
            'whatsup' => 'Whatsup',
        ];
    }

    /**
     * Gets query for [[Post0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(TeemsPost::className(), ['id' => 'post']);
    }
}
