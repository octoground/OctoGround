<?php

namespace app\models;

use Yii;
use app\models\SubjectBlog;
use app\models\Author;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $subject
 * @property string $author
 * @property string $post
 * @property string $main_img
 * @property string $read_img
 * @property string $text
 */
class Blog extends \yii\db\ActiveRecord
{
    public $filter = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_author', 'type_id'], 'integer'],
            [['text'], 'string'],
            [['subject', 'view'], 'string', 'max' => 50],
            [['img', 'desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'img' => 'Main Img',
            'text' => 'Text',
            'id_author' => 'Text',
            'type_id' => 'Text',
            'view' => 'Просмотры',
            'ddesc' => 'Просмотры',
            'date' => 'Дата'
        ];
    }

    public function getType()
    {
        return $this->hasOne(SubjectBlog::class, ['id' => 'type_id']);
    }
    public function getTypies()
    {
        return SubjectBlog::find()->all();
    }
    public function getArticlies()
    {
        if ($this->filter) 
        {
            $return = $this->find()->where(['type_id' => $this->filter])->all();
        }else{
            $return = $this->find()->all();
        }
        return $return;
    }
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }
    public function getAuthorArticlies()
    {
        return $this->findAll(['id_author' => $this->id_author]);
    }
}
