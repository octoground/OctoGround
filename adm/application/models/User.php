<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $is_admin;
    // public $authKey;
    // public $accessToken;


    public static function tableName()
    {
        return '{{%users}}';
    }

    public static function findIdentity($id)
    {

        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {

        $user = static::find()->where(['username' => $username])->asArray()->one();

        if ($user) {
            foreach ($user as $usr) {
                if (strcasecmp($usr, $username) === 0) {
                    return new static($user);
                }
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
