<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\helpers\EmailHelper;
use app\models\Order;


class AppForm extends Model
{

    public $name;
    public $phone;
    public $email;
    public $text;
    public $type;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'service'], 'trim'],
            [['email'], 'email'],
            [['type'], 'string', 'max' => 10],
            [['text'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Как к Вам обращаться?*',
            'phone' => 'Ваш телефон*',
            'email' => 'E-mail',
            'text' => 'Чем мы можем вам помочь?',
            'type' => 'Чем мы можем вам помочь?',
        ];
    }

    public function save()
    {
        $order = new Order();
        
        $order->name = $this->name;
        $order->phone = $this->phone;
        $order->email = $this->email;
        $order->text = $this->text;
        $order->type = $this->type;
        $order->created_at = time();
        $order->save();
    }
}
