<?php

use yii\helpers\Html;
use app\modules\admin\models\Post;
use app\modules\admin\models\PostCategory;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
?>
<div class="post-category-index">
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

            // 'id',
            [
                'attribute' => 'name',
                'label' => 'Категории',
            ],

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>