<?php
/**
 * Created by PhpStorm.
 * User: Ямиль
 * Date: 23.05.2016
 * Time: 17:46
 */

namespace app\components;

use yii;
use yii\db\Connection;
use yii\db\Exception;
use yii\helpers\Url;
use app\models\Settings;

class DbFrontEnd extends Connection
{
    public $driverName = 'mysql';
    public $host = 'localhost';


    public function open()    {
        /** @var Settings $frontEndSetting */

        $frontEndSetting = Settings::find()->where(['is_installed' => true])->one();
        
        $this->dsn = "{$frontEndSetting->db_driver_name}:host={$frontEndSetting->db_host};dbname={$frontEndSetting->db_name}";
        $this->username = $frontEndSetting->db_username;
        $this->password = $frontEndSetting->db_password;
        $this->charset = 'utf8';

        return parent::open();        
    }

    public function isActiveConnect($setting){
        try {
            $this->dsn = "{$setting->db_driver_name}:host={$setting->db_host};dbname={$setting->db_name}";
            $this->username = $setting->db_username;
            $this->password = $setting->db_password;
            $this->charset = 'utf8';
            parent::open();
            return true;
        } catch (Exception $e) {
            return Yii::$app->session->setFlash('danger', $e->getMessage());
        }
    }
}