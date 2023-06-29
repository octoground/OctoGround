<?php

namespace app\modules\users\models;

class Users extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'Users';
    }
}