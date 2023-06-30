<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\Portfolio;
use app\models\PortfolioType;
use app\models\Blog;
use app\models\AppForm;
use app\models\Author;
use app\models\Teems;
use app\models\Brief;

class SiteController extends Controller
{

	public function actionMain()
	{
		$portfolio = Portfolio::find()->limit(5)->all();
		$blogs = Blog::find()->orderBy(['date' => SORT_DESC])->limit(3)->all();
		$form = new AppForm();

		if (yii::$app->request->post()) {
			$form->load(yii::$app->request->post());
			if ($form->load(yii::$app->request->post())) {
				$form->save();
			}
			$form = new AppForm();
		}
		return $this->render('index', compact('portfolio', 'blogs', 'form'));
	}
	public function actionPortfolio()
	{
		$items = Portfolio::find()->all();
		$navigations = PortfolioType::find()->all();
		return $this->render('portfolio', compact('items', 'navigations'));
	}
	public function actionPortfolioAjax($type)
	{
		if ($type) {
			$items = Portfolio::find()->where(['type' => $type])->all();
		} else {
			$items = Portfolio::find()->all();
		}


		return json_encode([
			'template' => $this->renderPartial('include/_foreach_portfolio', compact('items'))
		]);
	}
	public function actionAbout($connect = false)
	{
		$teems = Teems::find()->all();
		if (yii::$app->request->isAjax) {
			$author = Teems::findOne(['id' => yii::$app->request->post()['id']]);
			return json_encode(['content' => $this->renderPartial('include/_author', compact('author'))]);
		}
		return $this->render('contact', compact('teems'));
	}
	public function actionBrief()
	{
		$brief = new Brief();

		if (yii::$app->request->post() && $brief->load(yii::$app->request->post())) {
			if ($brief->save()) {
				$brief->saveAdditional();
				$brief->saveService();

				return $this->redirect('/site/main?connect=true');
			}
		}

		return $this->render('brief', compact('brief'));
	}
	public function actionConnect()
	{
		$connectForm = new AppForm();
		if (yii::$app->request->post() && $connectForm->load(yii::$app->request->post())) {
			$connectForm->save();
			$referrer = stristr(Yii::$app->request->referrer, '?', true) ? stristr(Yii::$app->request->referrer, '?', true) : Yii::$app->request->referrer;
			return $this->redirect($referrer . '?connect=true');
		}
	}
	public function actionError()
	{
		return $this->render('error');
	}
}
