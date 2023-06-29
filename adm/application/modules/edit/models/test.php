<?php

namespace app\modules\edit\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $visa
 * @property string $departure
 *
 * @property TourShedule[] $tourShedules
 */
class test extends \yii\db\ActiveRecord
{

    public static function getDb()
    {
        return \Yii::$app->dbFrontEnd;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    public static function getAllCountries()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['visa'], 'integer'],
            [['code', 'name', 'departure'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'visa' => 'Visa',
            'departure' => 'Departure',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourShedules()
    {
        return $this->hasMany(TourShedule::className(), ['country_id' => 'id']);
    }
}
