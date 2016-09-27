<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Pages;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>
    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 3000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            // 'link',
            [
                'attribute' => 'link',
                'format' => 'html',
                'value' => function($data) {
                    $page = Pages::findOne(['link' =>  $data->link]);
                    if (!empty($page)) {
                        return Html::a( $data->link, ['/admin/pages/view', 'id' => $page->id]);
                    }
                    else return false;
                }
            ],
            'url',

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>