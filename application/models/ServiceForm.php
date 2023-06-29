<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\helpers\EmailHelper;
use app\models\Order;

class ServiceForm extends Model{
    
    public $name;
    public $phone;
    public $service;

    public function rules() {
        return [
            [['name', 'phone', 'service'], 'required'],
            [['name', 'service', 'phone'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => 'Как к Вам обращаться?',
            'phone' => 'Ваш телефон',
            'service' => 'Содержимое',
        ];
    }

    public function saveOrder(){
        $order = new Order();
        $email = new EmailHelper();
        $order->name = $this->name;
        $order->phone = $this->phone;
        $order->service = $this->service;

        if ($order->save()) {
            $email->emailTo = yii::$app->params['fromEmail'];
            $email->template = 'order';
            $email->data = [
                'name' => $this->name,
                'phone' => $this->phone,
                'service' => $this->service,
            ];
            $email->send();
            return true;
        }
    }
}