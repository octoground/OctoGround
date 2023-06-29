<?php

namespace app\helpers;

use yii;

class EmailHelper
{

	public $from; //от кого письмо, если пусто то подставляется yii::$app->params['fromEmail'] (string)
	public $template; //тело письма (string)
	public $emailTo; //email на которой отправляем письмо (string)
	public $data; //массив данных для отправки (massive)

	public function send()
	{

		// $this->from = $this->from ? $this->from : yii::$app->params['fromEmail'];
		yii::$app->mailer->compose($this->template, $this->data)
			->setFrom(yii::$app->params['fromEmail'])
			// ->setTo([$this->emailTo, $this->data['email']])
			->setTo([$this->emailTo])
			->setSubject($this->subject)
			->send();
	}
	public function send1()
	{

		// $this->from = $this->from ? $this->from : yii::$app->params['fromEmail'];
		yii::$app->mailer->compose($this->template, $this->data)
			->setFrom(yii::$app->params['fromEmail'])
			->setTo([$this->emailTo])
			->setSubject($this->subject)
			->send();
	}
}
