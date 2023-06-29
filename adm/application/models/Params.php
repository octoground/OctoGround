<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Params extends Model
{
    public $adminEmail;
    public $fromEmail;
    public $emailPass;
    public $hostMailer;
    public $portMailer;
    public $encryptionMailer;
    public $useFileTransport;
    public $logo;
    public $company;
    public $phone;

    public function rules()
    {
        return [
            [['fromEmail', 'adminEmail'], 'email'],
            [['emailPass', 'hostMailer', 'portMailer', 'encryptionMailer', 'logo', 'company', 'phone', 'useFileTransport'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'fromEmail' => 'Email, с которого будут отправляться письма',
            'emailPass' => 'пароль от Email',
            'hostMailer' => 'хостинг Email',
            'portMailer' => 'Порт',
            'encryptionMailer' => 'Тип шифрования',
            'useFileTransport' => 'Сохранять письма на сервере',
        ];

    }
    public function save()
    {
        $filename = Yii::getAlias('@webroot/../application/config/params.php');

        $head = '<?php return ';
        $footer = ';';
        


       


        $results = ArrayHelper::toArray($this); 
        // $results = str_replace("[", "'", $results);



        $res = $head.var_export($results, true).$footer;
        file_put_contents    ($filename, $res);
        // echo "<pre>";
        // var_dump($results);
        // echo "</pre>";
    }
}
