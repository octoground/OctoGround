<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Blog;

class BlogController extends Controller
{

    public function actionIndex()
    {
        $blog = new Blog();
        return $this->render('index', compact('blog'));
    }
    public function actionView($id)
    {
        $article = Blog::findOne(['id' => $id]);
        return $this->render('view', compact('article'));
    }
    public function actionFilter($id)
    {
        $blog = new Blog();
        $blog->filter = $id;
        return json_encode([
            'content' => $this->renderPartial('_blog_item', compact('blog'))
        ]);
    }
}
