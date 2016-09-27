<?php

namespace frontend\modules\blog\controllers;

use frontend\modules\blog\models\Posts;
use yii\web\Controller;
use Yii;

class SearchController extends Controller {

	public function actionIndex()
    {   $model = new Posts();
        $result = $model->getDataSearch();
        return $this->render('search', ['result' => $result]);
    }
}