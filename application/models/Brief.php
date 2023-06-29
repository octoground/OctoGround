<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\BriefAdditionalList;
use app\models\BriefService;
use app\models\BriefAdditional;
/**
 * This is the model class for table "brief".
 *
 * @property int $id
 * @property string|null $activity
 * @property string|null $desc
 * @property string|null $competitor
 * @property string|null $budget
 * @property string|null $comment
 * @property string|null $fio
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $link
 */
class Brief extends \yii\db\ActiveRecord
{
    public $serviceList = [];
    public $additionalList = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brief';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc', 'competitor', 'budget'], 'string'],
            [['activity'], 'string', 'max' => 500],
            [['fio'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 70],
            [['phone'], 'string', 'max' => 20],
            [['link'], 'string', 'max' => 120],
            [['serviceList', 'additionalList'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity' => 'Activity',
            'desc' => 'Desc',
            'competitor' => 'Competitor',
            'budget' => 'Budget',
            'fio' => 'Ваше имя*',
            'email' => 'E-mail',
            'phone' => 'Телефон*',
            'link' => 'Ссылка на ваш сайт',
        ];
    }

    public function getArrAdditional()
    {
        $list = BriefAdditionalList::find()->all();
        return ArrayHelper::map($list, 'id', 'title');
    }
    public function getBudgetList()
    {
        $list = [
            [
                'id' => '50000',
                'val' => '50 000т.р.'
            ],
            [
                'id' => '80000',
                'val' => '80 000т.р.'
            ],
            [
                'id' => '120000',
                'val' => '120 000т.р.'
            ],
            [
                'id' => '170000',
                'val' => '150 000т.р.'
            ],
            [
                'id' => '250000',
                'val' => '250 000т.р.'
            ]
        ];
        return ArrayHelper::map($list, 'id', 'val');
    }

    public function saveService()
    {
        $db = new BriefService();
        foreach ($this->serviceList as $key => $service) {
            $db->isNewRecord = true;
            $db->id = null;
            $db->title_service = $service;
            $db->brief_id = $this->id;
            $db->save();
        }
    }
    public function saveAdditional()
    {
        $db = new BriefAdditional();
        foreach ($this->additionalList as $key => $additional) {
            $db->isNewRecord = true;
            $db->id = null;
            $db->additional_title = $additional;
            $db->brief_id = $this->id;
            $db->save();
        }
    }
}
