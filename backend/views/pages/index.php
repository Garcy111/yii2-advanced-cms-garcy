<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

   <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>
    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 3000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'link',
            // 'content:ntext',
            'updated_at',

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>