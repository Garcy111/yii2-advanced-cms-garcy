<?php

namespace app\modules\blog\controllers;

use backend\models\Pages;
use frontend\modules\blog\models\Posts;
use yii\web\HttpException;
use yii\web\Controller;
use Yii;

class PagesController extends Controller {

	public function actionIndex($link = false)
    {   
    	$model = new Pages();
        $page = $model->find()->where(['link' => $link])->one();

        $popular = Posts::find()->orderBy('views DESC')->limit(3)->all();

        if (empty($page)) {
        	throw new HttpException(404 ,'Page not found');
        }
        return $this->render('page', ['page' => $page, 'popular' => $popular]);
    }
}